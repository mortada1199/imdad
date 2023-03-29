<?php

namespace App\Http\Resources\UMResources\User;

use App\Http\Resources\AccountResourses\Profile\ProfileResponse;
use App\Models\Settings\Setting;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "fullName" => $this->full_name,
            "identityNumber" => $this->identity_number,
            "identityType" => $this->identity_type,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "createdAt" => $this->created_at->format('y-m-d') ?? null,
            "otp" => $this->otp,
            "isSuperAdmin" => $this->is_super_admin,
            "status" => $this->roles()->where('profile_id', $this->profile_id)->first()->role->status ?? '',
            "roleId" => $this->roles()->where('profile_id', $this->profile_id)->first()->role->role_id ?? '',
            // inActive users get empty Permissions
            "permissions" => $this->roles()->where('profile_id', $this->profile_id)->where('status', 'active')->first()->role->permissions ?? [],
            "profileId" => $this->currentProfile() != null ? new ProfileResponse($this->currentProfile()) : null,
            "expireDate" => $this->expiry_date,
            "passwordChanged" => $this->password_changed,
            "mangerInfo" => $this->mangerUserId() ?? '',
            'warehouses' => $this->warehouses,
            "allProfiles" => DB::table("profile_role_user")->where("user_id", $this->id)->pluck("profile_id"),
            "lang" => $this->lang,
            "userCrNumbers" => $this->crNumbersList() ?? '',
            'isLearning' => $this->roles()->where('profile_id', $this->profile_id)->where('user_id', $this->id)->first()->role->is_learning ?? null,
            "avatar" => $this->getMedia('avatars'),
            "prefrence"=>DB::table('settings_models')->where('user_id',auth()->id())->first()->preferences??null
        ];
    }
}
