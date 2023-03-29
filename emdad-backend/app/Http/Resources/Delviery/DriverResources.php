<?php

namespace App\Http\Resources\Delviery;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResources extends JsonResource
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
            "nameAr" => $this->name_ar,
            "nameEn" => $this->name_en,
            "age" => $this->age,
            "phone" => $this->phone,
            "nationality" => $this->nationality,
            "profileId"=>$this->profile_id,
        ];
    }
}
