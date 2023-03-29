<?php

namespace App\Http\Services\UMServices;

use App\Http\Controllers\Auth\MailController;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\AccountServices\PackageConstraint;
use App\Http\Services\General\SmsService;
use App\Models\Accounts\Warehouse;
use App\Models\UM\RoleUserProfile;
use App\Models\UserWarehousePivot;
use DateTime;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class AuthenticationServices
{

    public function create($request)
    {
        // $packageLimit = new PackageConstraint;
        // $value = User::where('profile_id', auth()->user()->profile_id)->where('is_super_admin', true)->count();
        // $Limit = $packageLimit->packageLimitExceed("user", $value);
        // if ($Limit == false) {
        //     return response()->json([
        //         "statusCode" => "363",
        //         'success' => false,
        //         'message' => "You have exceeded the allowed number of Admin to create it"
        //     ], 200);
        // }

        return DB::transaction(function () use ($request) {
            $request['full_name'] = $request['fullName'];
            $request['expiry_date'] = $request['expireDate'] ?? null;
            $request['identity_number'] = $request['identityNumber'] ?? "";
            $request['identity_type'] = $request['identityType'] ?? 'nid';
            $request['otp_expires_at'] = now()->addMinutes(5);
            $request['is_super_admin'] = true;
            $request['password_changed'] = true;
            $request['lang'] = $request['lang'] ?? 'en';

            $user = User::create($request);

            return $user;
        });
    
    }




    public function update($request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
            "full_name" => $request->fullName ?? $user->full_name,
            "email" => $request->email ?? $user->email,
            "mobile" => $request->mobile ?? $user->mobile,
            "identity_number" => $request->identityNumber ?? $user->identity_number,
            'lang' =>  $request['lang'] ?? $user->lang,
        ]);

        $WarahouseId = $request->warahouseId ?? null;
        if ($WarahouseId != null) {
            try {
                $user->warehouse()->attach(
                    $user->id,
                    [
                        'warehouse_id' => $request->warahouseId,
                    ]
                );
            } catch (Exception $ex) {
            }
        }


        $userRoleProfile = RoleUserProfile::where('user_id', $user->id)->where('profile_id', $user->profile_id)->first();

        if ($request->has("roleId") && $userRoleProfile != null) {

            $userRoleProfile->update(['user_id' => $user->id, 'role_id' => $request['roleId'], 'profile_id' => auth()->user()->profile_id]);
        }
        if ($user->wasChanged('mobile')) {
            $user->update(['is_verified' => 0]);
            $this->UserOtp($user);
            return response()->json(
                [
                    "statusCode" => "000",
                    'message' => 'New OTP has been sent.',
                    'otp' => $user->otp,
                ],
                200
            );
        }
        if ($user) {
            return response()->json([
                "statusCode" => "000",

                'message' => 'User updated successfully',
                'data' => ['user' => new UserResponse($user)]
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }



    public function detachWarehouse($request)
    {
        $user = Warehouse::where("id", $request->warehouseId)->first();
        $user->users()->detach($request->userId);
        return response()->json([
            "statusCode" => "000",

            'message' => 'User deatched successfully'
        ], 200);
    }



    public function userWarehouseStatus($request)
    {
        $userWarehouse = UserWarehousePivot::where("user_id", $request->userId)->where("warehouse_id", $request->warehouseId)->first();
        if ($userWarehouse != null) {
            $userWarehouse->update(['status' => $request->status]);
            return response()->json([
                "statusCode" => "000",

                'message' => 'status update successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }



    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->orWhere('mobile', $request->mobile)->first();
        if ($user == null) {
            return response()->json(
                [
                    "statusCode" => "106",
                    "success" => false,
                    "error" => " User NOT Found"
                ],
                200
            );
        }


        if (isset($request->mobile)) {
            $user = User::where('mobile', '=', $request->mobile)->first();

            $data = $this->UserOtp($user);
            return response()->json(
                [
                    "statusCode" => "105",

                    "success" => true, "message" => "verifiy your otp first",
                    "data" => $data,
                ],
                200
            );
        }
        if (!($user->password === Hash('sha256',$request->password))) {
            return response()->json(
                [
                    "statusCode" => "104",

                    "success" => false, "error" => "Wrong credentials"
                ]
            );
        }

        if ($user->is_verified == 0) {
            $data = $this->UserOtp($user);

            return response()->json(
                [
                    "statusCode" => "105",

                    "data" => $data,
                    "success" => false, "error" => "Forbidden"
                ],
                200
            );
        }
        $token = $user->createToken('authtoken');

        return response()->json(
            [
                "statusCode" => "000",

                'message' => 'Logged in',
                'data' => [
                    'user' => new UserResponse($user),
                    'token' => $token->plainTextToken
                ]
            ]
        );
    }



    public function activate($request)
    {

        $user = User::where('id', $request->id)->orWhere('mobile', $request->mobile)->first();
        if ($request->otp != $user->otp) {
            return response()->json(
                [
                    "success" => false, "error" => "Invalid OTP", "statusCode" => "101"
                ],
                200
            );
        } elseif ($user->otp_expires_at < now()) {
            return response()->json(
                [
                    "success" => false, "error" => "Expired OTP", "statusCode" => "102"
                ],
                200
            );
        } elseif ($user->is_verified == true) {
            return response()->json(
                [
                    "success" => false, "error" => "Your Account Already Activated", "statusCode" => "103"
                ],
                200
            );
        }

        $user->update(['is_verified' => true]);
        $token = $user->createToken('authtoken');
        return response()->json(
            [
                "statusCode" => "000",
                'message' => 'Your account has been activated successfully.',
                'token' => $token->plainTextToken,
                "user" => new UserResponse($user),
            ],

            200
        );
    }


    public function resend($request)
    {
        $user = isset($request->mobile) ? User::where('mobile', '=', $request->mobile)->first() : User::where('email', '=', $request->email)->first();
        if($user){
            $data = $this->UserOtp($user);
            MailController::sendSignupEmail($user->name, $user->email, $user->otp, $user->lang);
        }else{
            $data = null;
        }
        return $data;
    }

    public function logout()
    {
        $user = auth()->user()->tokens()->delete();
        session()->invalidate();

        return response()->json(
            [

                "statusCode" => "000",

                'message' => 'Logged out', 'user' => $user
            ],
            200
        );
    }


    public function forgotPassword($request)
    {
        $token = self::checkToken($request);

        if ($token != null) {
            return response()->json([
                "statusCode" => "109",

                "success" => false,
                'message' => 'Rest Link has been already sent to your email',
            ], 200);
        }
        DB::table('password_resets')->insert([
            'token' => Str::uuid(),
            'email' => $request->email,
            "created_at" => now()->addHours(3),
        ]);
        $user = User::where("email", $request->email)->first();
        MailController::forgetPasswordEmail($user->full_name, $user->email, $user->otp, $user->lang);
        if ($user) {
            return response()->json([
                "statusCode" => "000",

                "success" => true,
                'message' => ' Rest Link has been sent to your email address ',
                "email" => $request->email,
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            "success" => false,
            'message' => 'System error ',
        ], 200);
    }

    // Todo  Need Code Again !
    public function resetPassword($request)
    {
        $token = self::getResetToken($request);
        if ($token == null) {
            return response()->json([
                "statusCode" => "107",

                "success" => false,
                'message' => 'invalid token',
            ], 200);
        } elseif ($token != null && now() > DateTime::createFromFormat('Y-m-d H:i:s', $token->created_at)) {
            DB::table('password_resets')->where([
                'email' => $token->email,
                'token' => $token->token
            ])->delete();

            return response()->json([
                "statusCode" => "107",

                "success" => false,
                'message' => 'invalid token',
            ], 200);
        }

        $user = User::where('email', $request->email)->first();

        $user->update(['password' => $request->password]);

        event(new PasswordReset($user));
        if ($user) {
            DB::table('password_resets')->where([
                'email' => $token->email,
                'token' => $token->token
            ])->delete();

            return response()->json([
                "statusCode" => "000",

                "success" => true,
                'message' => 'password Reste successfly',
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            "success" => false,
            'message' => 'system Error',
        ], 200);
    }



    public function setDefaultCompany($request)
    {

        $user = User::where("id", auth()->id())->first();
        $user->update(
            [
                "profile_id" => $request->profileId
            ]
        );

        return response()->json([
            "statusCode" => "000",

            'message' => 'Default company successfully',
            'data' => ['user' => new UserResponse($user)]
        ], 200);
    }





    public function removeUser($id)
    {
        $user = User::find($id);

        $user->tokens()->delete();

        $user->forceDelete();
        if ($user) {
            return response()->json([
                "statusCode" => "000",

                'message' => 'User delete form database successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",
            'error' => 'system error'
        ], 200);
    }


    public  function UserOtp($user)
    {

        $smsService = new SmsService;
        $otp = rand(1000, 9999);
        $user->update(['otp' => strval($otp), 'otp_expires_at' => now()->addMinutes(5), 'is_verified' => 0]);

        $smsService->sendSms($user->mobile, $user->otp);

        return
            [
                'message' => 'New OTP has been sent.',
                'otp' => $user->otp,
                "id" => $user->id,

            ];
    }

    function getResetToken($request)
    {
        $token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->latest()->first();

        return $token;
    }

    function checkToken($request)
    {
        $token = DB::table('password_resets')->where([
            'email' => $request->email,
        ])->latest()->first();

        return $token;
    }

    public function checkLink($request)
    {
        $token = $this->getResetToken($request);

        if ($token == null) {
            return response()->json(
                [
                    'statusCode' => '108',

                    "error" => "token or email is invalid",
                ],
                200
            );
        }

        if (now() < DateTime::createFromFormat('Y-m-d H:i:s', $token->created_at)) {
            return response()->json([
                'statusCode' => '000',
                'message' => 'token is valid'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => '107',
                'error' => 'token expired',
            ], 200);
        }
    }


    
}
