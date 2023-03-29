<?php

namespace App\Http\Services\General;

use Illuminate\Support\Facades\DB;

class CheckService
{
    public static function checkTwoTypes($user, $type1,$type2)
    {
        if ($user->currentProfile()->type == "Buyer" || $user->currentProfile()->type == "Supplier") {
            $permissonis = DB::table('profile_role_user')->where('user_id', $user->id)->where('profile_id', $user->profile_id)->pluck('permissions')->first();
            if ($permissonis != null) {
                $labels = json_decode($permissonis);

                if(is_array($labels) == false){
                    if ($labels == $type1 || $labels == $type2) {
                        return true;
                    }else{
                        return false;
                    }
                }elseif(is_array($labels)){

                    foreach ($labels as $label) {
                        if ($label == $type1 || $label == $type2) {
                            return true;
                        }
                    }
                    return false;
                }
                return false;
            }
        }
    }

    public static function checkOneType($user, $type1)
    {
        if ($user->currentProfile()->type == "Buyer" || $user->currentProfile()->type == "Supplier") {
            $permissonis = DB::table('profile_role_user')->where('user_id', $user->id)->where('profile_id', $user->profile_id)->pluck('permissions')->first();
            if ($permissonis != null) {
                $labels = json_decode($permissonis);

                if(is_array($labels) == false){
                    if ($labels == $type1) {
                        return true;
                    }else{
                        return false;
                    }
                }elseif(is_array($labels)){

                    foreach ($labels as $label) {
                        if ($label == $type1) {
                            return true;
                        }
                    }
                    return false;
                }
                return false;
            }
        }
    }

     // public function checkPermission($user, $type1,$type2)
    // {
    //     if ($user->currentProfile()->type == "Buyer" || $user->currentProfile()->type == "Supplier") {
    //         $permissonis = DB::table('profile_role_user')->where('user_id', $user->id)->where('profile_id', $user->profile_id)->pluck('permissions')->first();
    //         if ($permissonis != null) {
    //             $labels = json_decode($permissonis);
    //             foreach ($labels as $label) {
    //                 if ($label == $type1 || $label == $type2) {
    //                     return true;
    //                 }
    //             }
    //         }
    //     }
    // }
}
