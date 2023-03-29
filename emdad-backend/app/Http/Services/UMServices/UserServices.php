<?php

namespace App\Http\Services\UMServices;

use App\Http\Controllers\Auth\MailController;

use App\Models\User;
use App\Models\UM\Role;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\AccountServices\PackageConstraint;
use App\Http\Services\General\SmsService;
use App\Models\UM\Permission;
use App\Models\UM\RoleUserProfile;
use App\Models\UserWarehousePivot;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\NotIn;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserServices
{

    public function create($request)
    {

        $packageLimit = new PackageConstraint;
        $output = [];
        $check = in_array($request['roleId'], [1, 2, 3, 4, 12]);
        $user = null;


        if ($check == true) {
            $value = DB::table('profile_role_user')->where('profile_id', auth()->user()->profile_id)->whereIn('role_id', [1, 2, 3, 4, 12])->count();
            $newvalue = (--$value);
            $limit = $packageLimit->packageLimitExceed("owner", $newvalue);


            if ($limit == false) {
                $output = [
                    "statusCode" => "360",
                    'success' => false,
                    'message' => "You have exceeded the allowed number of Admins to create it"
                ];
                return $output;
            } elseif ($limit != true && $limit == "package null") {
                $output = [
                    "statusCode" => "364",
                    'success' => false,
                    'message' => "You have not specified a package"
                ];
                return $output;
            }
            $user = $this->createUser($request);
        } else {
            $value = DB::table('profile_role_user')->where('profile_id', auth()->user()->profile_id)->whereNotIn('role_id', [1, 2, 3, 4, 12])->count();
            $limit = $packageLimit->packageLimitExceed("user", $value);
            if ($limit == false) {
                $output = [
                    "statusCode" => "360",
                    'success' => false,
                    'message' => "You have exceeded the allowed number of Users to create it"
                ];
                return $output;
            } elseif ($limit != true && $limit == "package null") {
                $output = [
                    "statusCode" => "364",
                    'success' => false,
                    'message' => "You have not specified a package"
                ];
                return $output;
            }
            $user = $this->createUser($request);
        }

        if ($user != null) {
            $output = ["data" => $user, "message" => "user Created successfully", "statusCode" => "000"];
            return $output;
        } else {
            $output = ["data" => null, 'message' => "user not created", "statusCode" => "999"];
            return $output;
        }
    }


    public function UpdateOwnerUser($request, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->checkUserRole($user_id);

        if ($user == true) {
            return response()->json([
                "statusCode" => "999",

                'message' => 'cano,t  updated User'
            ], 200);
        }
        $this->update($request, $user_id);
    }

    public function update($request, $id)
    {


        $user = User::where('id', $id)->first();
        $user->update([
            "full_name" => $request->fullName ?? $user->full_name,
            "email" => $request->email ?? $user->email,
            "mobile" => $request->mobile ?? $user->mobile,
            "identity_number" => $request->identityNumber ?? $user->identity_number,
            'expiry_date' => $request['expireDate'] ?? $user->expiry_date,
            'lang' =>  $request['lang'] ?? $user->lang,

        ]);

        $Warehouses = $request['warehouseId'] ?? null;
        if ($Warehouses != null) {
            try {
                foreach ($Warehouses as $warehouse) {
                    $user->warehouses()->attach(
                        $user->id,
                        [
                            'warehouse_id' => $warehouse,
                        ]
                    );
                }
            } catch (Exception $ex) {
            }
        }


        $userRoleProfile = DB::table('profile_role_user')->where('user_id', $user->id)->where('profile_id', $user->profile_id)->first();

        if ($request->has("roleId") && $userRoleProfile != null) {

            if ($id == auth()->id() && $request->status != $userRoleProfile->status) {

                $output = [
                    "statusCode" => "110",
                    'success' => false,
                    'message' => "you can't  disable your self"
                ];
                return $output;
            }
            $user->profiles()->updateExistingPivot($user->profile_id, ['role_id' => $request['roleId'] ?? $userRoleProfile->role_id, 'user_id' => $user->id ?? $userRoleProfile->user_id,  'status' => $request['status'] ?? $userRoleProfile->status, "manager_user_Id" => $request['managerUserId'] ?? $userRoleProfile->manager_user_Id, 'is_learning' => $request['isLearning'] ?? $userRoleProfile->is_learning, 'permissions' =>isset($request['permissions']) ? json_encode($request['permissions'], true): $userRoleProfile->permissions]);

        }
        
        
        if ($user->wasChanged('mobile')) {
            $user->update(['is_verified' => 0]);
            $this->UserOtp($user);
            MailController::sendSignupEmail($user->name, $user->email, $user->otp, $user->lang, "otp");

            $output = ["otp" => $user->otp, "message" => "New OTP has been sent.", "statusCode" => "000"];
            return $output;
        }
        if ($user) {
            $output = ["data" => $user, "message" => "user updated successfully", "statusCode" => "000"];
            return $output;
        } else {
            $output = ["data" => null, 'message' => "user not updated", "statusCode" => "999"];
            return $output;
        }
    }

    public function detachWarehouse($request)
    {
        $user = User::find($request->userId);

        $warehouse = $user->warehouses()->where('warehouse_id', $request->warehouseId)->first();

        if ($warehouse == null) {
            $output = ['message' => "the user is not attached to this warehouse", "statusCode" => "111"];
            return $output;
        }
        if ($warehouse != null) {
            $user->warehouses()->detach($request->warehouseId);

            $output = ['message' => "warehouse has been detached successfully", "statusCode" => "000"];
            return $output;
        }
    }

    public function userWarehouseStatus($request)
    {
        $user = User::find($request->userId);

        if ($user != null) {
            $user->warehouses()->updateExistingPivot($request->warehouseId, ['status' => $request->status]);
            $output = ["message" => "status update successfully", "statusCode" => "000"];
            return $output;
        } else {
            $output = ["message" => "system error", "statusCode" => "999"];
            return $output;
        }
    }



    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->orwhere('mobile', $request->mobile)->first();

        if (isset($request->mobile)) {
            $user = User::where('mobile', '=', $request->mobile)->first();

            $data = $this->UserOtp($user);
            MailController::sendSignupEmail($user->name, $user->email, $user->otp, $user->lang, "otp");

            return response()->json(
                [
                    "statusCode" => "105",

                    "success" => true, "message" => "verifiy your otp first",
                ],
                200
            );
        }

        if (!($user->password === $request->password)) {
            return response()->json(
                [
                    "statusCode" => "104",

                    "success" => false, "error" => "Wrong credentials"
                ],
                200
            );
        }

        if ($user->is_verified == 0) {
            $data = $this->UserOtp($user);
            MailController::sendSignupEmail($user->name, $user->email, $user->otp, $user->lang, "otp");

            return response()->json(
                [
                    "statusCode" => "105",

                    "success" => true, "message" => "verifiy your otp first",
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
                ], 200
            ]
        );
    }

    public function activate($request)
    {

        $user = User::where('id', $request->id)->orWhere('mobile', $request->mobile)->first();
        if ($request->otp != $user->otp) {
            return response()->json(
                [
                    "statusCode" => "101",

                    "success" => false, "error" => "Invalid OTP"
                ],
                200
            );
        } elseif ($user->otp_expires_at < now()) {
            return response()->json(
                [
                    "statusCode" => "102",

                    "success" => false, "error" => "Expired OTP"
                ],
                200
            );
        } elseif ($user->is_verified == true) {
            return response()->json(
                [
                    "statusCode" => "103",

                    "success" => false, "error" => "Your Account Already Activated"
                ],
                200
            );
        }

        $user->update(['is_verified' => true, 'password_changed' => 1]);
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
        $this->UserOtp($user);
        MailController::sendSignupEmail($user->name, $user->email, $user->otp, $user->lang, "otp");
        return response()->json(
            [
                "statusCode" => "000",
                'message' => 'New OTP has been sent.',
            ],
            200
        );
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

    public function delete($id)
    {

        $user = User::find($id)->first();
        if ($user == null) {
            $output = ['statusCode' => '000', 'message' => 'user already deleted'];
            return $output;
        }

        $user->tokens()->delete();

        $deleted = $user->delete();

        if ($deleted) {
            $output = ['statusCode' => '000', 'message' => 'User deleted successfully'];
            return $output;
        }
        $output = ['statusCode' => '999', 'error' => 'system error'];
        return $output;
    }


    public function restoreById($request)
    {
        $packageLimit = new PackageConstraint;
        $value = User::where('profile_id', auth()->user()->profile_id)->where('is_super_admin', false)->count();
        $limit = $packageLimit->packageLimitExceed("user", $value);
        if ($limit == false) {
            $output = [
                "statusCode" => "360",
                'success' => false,
                'message' => "You have exceeded the allowed number of users to create it"
            ];
            return $output;
        } elseif ($limit != true && $limit == "package null") {
            $output = [
                "statusCode" => "364",
                'success' => false,
                'message' => "You have not specified a package"
            ];
            return $output;
        }

        $restore = User::where('id', $request->id)->withTrashed()->first()->restore();

        if ($restore) {
            $output = ['statusCode' => '000', 'message' => 'User restored successfully'];
            return $output;
        }
        $output = ['statusCode' => '999', 'error' => 'system error'];
        return $output;
    }




    // Todo  Need Code Again !
    public function resetPassword($request)
    {
        $user = User::where('email', $request->email)->first();

        $user->update(['password' => $request->password]);

        event(new PasswordReset($user));
        if ($user) {
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

    public function assignRole($request)
    {
        $colmun = gettype($request->json()->get('role')) == 'integer' ? 'id' : 'name';
        $role = Role::where($colmun, $request->json()->get('role'))->first();
        $user = User::find($request->get('userId'));
        $companyId = $request->get('companyId');
        $userId = $request->get('userId');
        $user->roleInCompany()->attach($userId, ['roles_id' => $role->id, 'company_info_id' => $companyId]);
        return response()->json([
            "statusCode" => "000",

            'message' => 'assign role successfully'
        ], 200);
    }

    // public function userActivate($request)
    // {
    //     $user = User::where('id', $request->userId)->first();
    //     $userRoleProfile = RoleUserProfile::where('profile_id', $user->profile_id)->first();

    //     if ($userRoleProfile == null) {
    //         $output = ['statusCode' => '263', 'error' => 'user doesn\'t belong to this company'];
    //         return $output;
    //     }
    //     $active = $userRoleProfile->update(['status' => 'active']);
    //     if ($active) {
    //         $output = ['statusCode' => '000', 'message' => 'user account has been activated successfully'];
    //         return $output;
    //     }
    //     $output = ['statusCode' => '999', 'error' => 'system error'];
    //     return $output;
    // }


    public function disable($request)
    {
        if ($request->userId == auth()->id()) {

            $output = ['statusCode' => '110', 'message' => 'you cannot update your self'];
            return $output;
        } else {

            $user = User::find($request->userId);

            // $userRoleProfile = RoleUserProfile::where('profile_id', $user->profile_id)->first();
            $profile = $user->profiles()->where('profile_id', $user->profile_id)->first();

            $active = $user->profiles()->updateExistingPivot($user->profile, ['status' => $profile->profile->status == "inActive" ? "active" : "inActive"]);
            if ($active) {
                $output = ['statusCode' => '000', 'message' => 'user status changed successfully'];
                return $output;
            }
            $output = ['statusCode' => '999', 'message' => 'system error'];
            return $output;
        }
    }

    public function restoreOldRole($request)
    {
        $userRoleCompany = RoleUserProfile::where('user_id', $request->userId)->where('profile_id', $request->profile_id)->withTrashed()->first()->restore();
        if ($userRoleCompany) {
            return response()->json([
                "statusCode" => "000",
                'message' => 'restored successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
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

        $output = ["data" => $user, "message" => "Default company successfully", "statusCode" => "000"];
        return $output;
    }



    public function showById($id)
    {
        #code...
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
    protected function getAbilities()
    {
        $role_id = RoleUserProfile::where('user_id', auth()->id())->where('profile_id', auth()->user()->profile_id)->first();
        $permissions = Permission::where('role_id', $role_id)->get();
        return $permissions;
    }

    public  function UserOtp($user)
    {

        $smsService = new SmsService;

        $otp = rand(1000, 9999);

        $user->update(['otp' => strval($otp), 'otp_expires_at' => now()->addMinutes(5), 'is_verified' => 0]);


        $smsService->sendSms($user->mobile, $user->password, 'password');
    }

    public function createUser($request)
    {

        return DB::transaction(function () use ($request) {
            $request['full_name'] = $request['fullName'];
            $request['expiry_date'] = $request['expireDate'] ?? null;
            $request['identity_number'] = $request['identityNumber'] ?? "";
            $request['identity_type'] = $request['identityType'] ?? 'nid';
            $request['otp_expires_at'] = now()->addMinutes(5);
            $request['is_super_admin'] = false;

            $user = User::create($request);
      
            $role_id = $request['roleId'] ?? null;
            $is_learning = $request['is_learning'] ?? false;
            $manager_id = null;
            if (isset($request['managerUserId'])) {
                $manager_id = $request['managerUserId'];
            } else {
                $manager_id = auth()->id() ?? null;
            }
            if ($role_id && $manager_id) {
                //TODO change the way to create permissions from get it back form db to requet  
                $permissions = Role::where("id", $role_id)->first()->permissions_list;

                $user->roleInProfile()->attach($user->id, ['user_id' => $user->id, 'role_id' => $role_id, "created_by" => auth()->id(), 'profile_id' => auth()->user()->profile_id, 'is_learning' => $is_learning, 'status' => $request['status'], 'manager_user_Id' => $manager_id, 'permissions' => isset($request['permissions']) ? json_encode($request['permissions'], true) : $permissions]);

                $user->update(['profile_id' => auth()->user()->profile_id]);
            }
            if (isset($request['warehouseId'])) {
                foreach ($request['warehouseId'] as $warehouse_id) {
                    try {
                        $user->warehouses()->attach($user, ['warehouse_id' => $warehouse_id]);
                    } catch (Exception $e) {
                    }
                }
            }
            return $user;
        });
    }


    public function addPermissionToUser($request)
    {

        # code...
        // seearch in profile-role-user where user_id and auth->profile
        // get permissions list and add permission to the list
        // if the new list after adding equals to another role permission list from roles table
        // suggest change user role 

        $roles = Role::where("type", auth()->user()->currentProfile()->type)->get();
    }

    public function checkTheRole($arrayOne, $arrayTwo)
    {
        $result =  array_diff($arrayOne, $arrayTwo);
        if (count($result) != 0)
            return false;
        else {
            return true;
        }
    }
    public function uploadAvatar($request)
    {
        $user = User::where('id', auth()->id())->first();
        if (isset($request['attachementFile'])) {
            $user->clearMediaCollection('avatars');
            $user->addMedia($request['attachementFile'])->toMediaCollection('avatars');
            $output = ["message" => "Avater updated Successfully", "statusCode" => "000"];
            return $output;
        } else {
            $output = ["message" => "system error", "statusCode" => "999"];
            return $output;
        }
    }
}
