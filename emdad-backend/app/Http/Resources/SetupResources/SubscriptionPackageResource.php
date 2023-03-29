<?php

namespace App\Http\Resources\SetupResources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPackageResource extends JsonResource
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
            "packageId"=>$this->id,
            "packageNameAr"=>$this->package_name_ar,
            "packageNameEn"=>$this->package_name_en,
            "price"=>auth()->user()->oldOwner()? $this->price_2:$this->price_1,
            "hasAnotherCompany"=>auth()->user()->oldOwner(),
            "features"=>json_decode($this->features),
        ];
    }
}
