<?php

namespace App\Http\Resources\Subscription;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'id'=>$this->id,
            'profileId'=>$this->profile_id,
            'packageId'=>$this->package_id,
            'userId'=>$this->user_id,
            'subTotal'=>$this->sub_total,
            'expireDate'=>$this->expire_date,
            'discount'=>$this->discount,
            'taxAmount'=>$this->tax_amount,
            'paymentID'=>$this->tx_id,
            "paymentUrl"=>"https://payments-dev.urway-tech.com/URWAYPGService/direct.jsp",
            'total'=>$this->total,
            'status'=>$this->status,
        ];
    }
}
