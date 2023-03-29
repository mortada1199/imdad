<?php

namespace App\Http\Services\AccountServices;

use App\Models\SubscriptionPayment;
use Exception;

class PackageConstraint
{

    public function parsePackageFeatures()
    {
        $checkResposne = $this->checkPackageValidity();
        if ($checkResposne['success']) {
            $features = json_decode($checkResposne['package']);
            return $features;
        }
        return $feature = [];
    }


    public function packageLimitExceed($key, $value)
    {
        // admin user + warehouse + 
        $features = $this->parsePackageFeatures();
        if($features == null){
            return "package null";
        }
        foreach ($features  as $feature) {
            if ($feature->key==$key && $feature->systemValue > $value) {
                return true;
            } 
        }
            return false;
    }

    public function checkPackageValidity()
    {
        $subscirptionPayment = null;
        try {
            // get current subscritpitons
            $subscirptionPayment = auth()->user()->currentProfile()->subscription_details;

            $subs = SubscriptionPayment::where('profile_id', auth()->user()->profile_id)->latest()->first();

            if (now() < $subs->expire_date) {
                // package subscription is valid return package with success true
                return ["success" => true, "package" => $subscirptionPayment];
            } else {
                // package subscription is not valid return package with success false
                return ["success" => false, "package" => auth()->user()->currentProfile->subscription_details];
            }
        } catch (Exception $ex) {
            return ["success" => "false", "package" => null];
        }
    }
}
