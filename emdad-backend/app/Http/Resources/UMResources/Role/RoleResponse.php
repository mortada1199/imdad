<?php

namespace App\Http\Resources\UMResources\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResponse extends JsonResource
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
            "name_ar" =>$this->name_ar,
            "name_en" =>$this->name_en,
            "type" =>$this->type,
            "permissions" =>$this->permissions_list,
        ];
    }
}
