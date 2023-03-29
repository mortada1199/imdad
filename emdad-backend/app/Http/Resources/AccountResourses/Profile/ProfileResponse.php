<?php

namespace App\Http\Resources\AccountResourses\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResponse extends JsonResource
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
            "name" => $this->name_ar,
            "ProfileType" => $this->type,
            "vatNmber" => $this->vat_number,
            "CrExpiredDate" => $this->cr_expire_data,
            "active" => $this->active,
            "crExpireData" => $this->cr_expire_data,
            "subscriptionDetails" => $this->subscription_details,
            "subscriptionId" => $this->subs_id,
            "iban" => $this->iban,
            "bank" => $this->bank,
            "swift" => $this->swift,
            "payments"=>$this->subscriptionPayments(),
            "createdBy" => $this->creatorName()->full_name??'',
            "logoImages" => $this->getMedia('profileLogo')
        ];
    }
}


