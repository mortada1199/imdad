<?php

namespace App\Http\Resources\UMResources\Department;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResponse extends JsonResource
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
            'name'=>$this->name,
            'profileId'=>$this->profile_id
        ];
    }
}
