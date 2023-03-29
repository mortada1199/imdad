<?php

namespace App\Http\Resources\AccountResourses\warehouses;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseTypeResponse extends JsonResource
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
            "nameEn"=>$this->name_en,
            "nameAr"=>$this->name_ar,
            "createdAt"=>$this->created_at->format('y-m-d'),
        ];
    }
}
