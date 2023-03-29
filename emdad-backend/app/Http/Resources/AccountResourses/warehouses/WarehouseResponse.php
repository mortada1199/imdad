<?php

namespace App\Http\Resources\AccountResourses\warehouses;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResponse extends JsonResource
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
            "id" =>$this->id,
            "profileId" =>$this->profile_id,
            "warehouseName" =>$this->address_name,
            "warehouseType" => auth()->user()->lang == 'en' ? $this->warehouse_type->name_en : $this->warehouse_type->name_ar ,
            "gateType" =>$this->gate_type,
            "latitude" =>$this->latitude,
            "longitude"=>$this->longitude,
            "receiverName" =>$this->address_contact_name,
            "receiverPhone" =>$this->address_contact_phone,
            "otpVerfied" =>$this->otp_verfied,
            "otp"=>$this->otp_receiver,
            "confirmBy" =>$this->confirm_by,
            "creatorName"=>$this->creatorName()->full_name,
            "createdAt"=>$this->created_at->format('y-m-d'),
            "managerName"=>$this->manager()->full_name,
            "users"=>$this->users,
        ];
    }
}
