<?php

namespace App\Http\Services;

use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Services\General\UrwayGateway;
use App\Models\Accounts\SubscriptionPackages;
use App\Models\Payment_tx;
use App\Models\Profile;
use App\Models\SubscriptionPayment;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use GrahamCampbell\ResultType\Success;

class SubscriptionPaymentService
{

    public function store($request)
    {

        $dt = new Carbon();

        $user = User::where('id', auth()->id())->first();

        $subscription = SubscriptionPackages::where('id', $request->packageId)->first();

        $payedSubscription = SubscriptionPayment::where('profile_id', auth()->user()->profile_id)->first();
        $oldOwner = $user->oldOwner();

        $price = $oldOwner == true ? $subscription->price_2 : $subscription->price_1;

        $status = $price == 0 ? "Paid" : "Pending";

        if ($payedSubscription == null ||  Carbon::now() > $payedSubscription->expire_date) {


            $SubscriptionPayment = SubscriptionPayment::create([
                'profile_id' => auth()->user()->profile_id,
                'package_id' => $request->packageId,
                'user_id' => auth()->id(),
                'sub_total' => $price,
                'expire_date' => $dt->addYear(),
                'tax_amount' => $price * 15 / 100,
                'total' => ($price + ($price * 15 / 100)),
                'status' => $status
            ]);
            if ($SubscriptionPayment->total > 0) {


                $payment = Payment_tx::create([
                    'amount' => $SubscriptionPayment->total,
                    'type' => "subscription",
                    'provider' => "urway",
                    'status' => "Pending",
                    'ref_id' => $SubscriptionPayment->id,
                ]);
            }
            $user->profile()->update(['subs_id' => $request->packageId, 'subscription_details' => $subscription->features]);
            return response()->json(['data' => new SubscriptionResource($SubscriptionPayment), "oldOwner" => $oldOwner, "statusCode" => "000"], 200);
        } else {
            if ($payedSubscription->status === 'Pending') {
                $payedSubscription->update([
                    'package_id' => $request->packageId,
                    'user_id' => auth()->id(),
                    'sub_total' => $price,
                    'expire_date' => $dt->addYear(),
                    'tax_amount' => $price * 15 / 100,
                    'total' => ($price + ($price * 15 / 100)),
                    'status' => $status

                ]);
                $user->profile()->update(['subs_id' => $request->packageId, 'subscription_details' => $subscription->features]);
                return response()->json(['data' => new SubscriptionResource($payedSubscription), "oldOwner" => $oldOwner, 'statusCode' => "000"], 200);
            }
        }
        return response()->json(['success' => false, "error" => "you  have ALready  Active Subscriptions ", 'statusCode' => '511'], 200);
    }


    public function check_subscription_payment()
    {
        $status = SubscriptionPayment::where('profile_id', auth()->user()->profile_id)->pluck('status')->first();
        if ($status) {
            return response()->json(['status' => $status], 200);
        } else {
            return response()->json(['message' => 'error', 'statusCode' => '999'], 200);
        }
    }




    public function delete($id)
    {
        $subscription = SubscriptionPayment::find($id)->first();
        if ($subscription != null) {
            $deleted = $subscription->delete();
            if ($deleted) {
                return response()->json(['message' => 'deleted successfully', 'statusCode' => '112'], 200);
            }
        }


        return response()->json(['error' => 'system error', 'statusCode' => '999'], 200);
    }

    public function pay()
    {
        # code...
        $user = User::where("id", auth()->id())->first();
        $profile = Profile::where("id", $user->profile_id)->first();
        $paymentRequest = SubscriptionPayment::where("profile_id", $profile->id)->where("status", "Pending")->first();
        $paymentRef = Payment_tx::where("ref_id", $paymentRequest->id)->where('type', 'subscription')->first();


        if ($paymentRequest == null) {
            return response()->json(['error' => 'not found', 'statusCode' => '111'], 200);
        }
        $request = ["transId" => $paymentRef->id, "trackId" => $paymentRef->id, "amount" => $paymentRef->amount, 'email' => $user->email];
        try {
            $response = UrwayGateway::initPayment($request);
            $json = json_decode($response, true);
            dd($json);

            $paymentRef->update(['gateway_tx_id' => $json['payid']]);

            return response()->json(['data' => new SubscriptionResource($paymentRequest), 'statusCode' => "000"], 200);
        } catch (Exception $e) {

            return response()->json(['success' => $json['result'], 'message' => $json["reason"], 'statusCode' => $json['responseCode']], 200);
        }
    }

    public function checkPaymentStatus()
    {
        $user = User::where("id", auth()->id())->first();
        $profile = $user->currentProfile();
        $paymentRequest = SubscriptionPayment::where("profile_id", $profile->id)->first();
        $paymentRef = Payment_tx::where("ref_id", $paymentRequest->id)->where('type', 'subscription')->first();

        if ($paymentRequest == null) {
            return response()->json(['message' => "you have not selected any package yet", "statusCode" => "111"], 200);
        }
        if ($paymentRequest->status == "Paid") {
            return response()->json(['data' => new SubscriptionResource($paymentRequest), "statusCode" => "000"], 200);
        }
        if ($paymentRequest->status == "Pending") {
            $request = ["transId" => $paymentRef->gateway_tx_id, "trackId" => $paymentRef->id, "amount" => $paymentRef->amount, 'email' => $user->email];
            try {
                $response = UrwayGateway::getPaymentStatus($request);
                $json = json_decode($response, true);
                // DB transaction
                if ($json['responseCode'] == 000 && $json['result'] == "Successful") {
                    $paymentRef->update(['status' => 'Paid']);
                    $paymentRequest->update(['tx_id' => $paymentRef->id, 'status' => 'paid']);

                    return response()->json(['data' => new SubscriptionResource($paymentRequest), "statusCode" => "000"], 200);
                } elseif ($json['responseCode'] == 601 && $json['result'] == "UnSuccessful") {
                    return response()->json(['Success' => $json['result'], 'data' => new SubscriptionResource($paymentRequest), "statusCode" => "601"], 200);
                }
            } catch (Exception $e) {
                return response()->json(['success' => $json['result'], 'message' => $json["reason"], 'statusCode' => $json['responseCode']], 200);
            }
        }
    }
}
