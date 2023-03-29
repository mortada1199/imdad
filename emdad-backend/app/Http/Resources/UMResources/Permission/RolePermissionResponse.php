<?php

namespace App\Http\Resources\UMResources\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionResponse extends JsonResource
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
            "roleId"=>$this-> role_id, 
            "permissionList" =>$this->json ,
        ];
    }
}
