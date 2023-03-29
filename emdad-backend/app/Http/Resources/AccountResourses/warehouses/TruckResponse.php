<?php

namespace App\Http\Resources\AccountResourses\warehouses;

use Illuminate\Http\Resources\Json\JsonResource;

class TruckResponse extends JsonResource
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
            'name'=>$this->name,
            'type'=>$this->type,
             'class'=>$this->class,
              'color'=>$this->color,
              'model'=>$this->model,
              'size'=>$this->size,
              'brand'=>$this->brand,
              "status"=>$this->status,
              "plateNumber"=>$this->plate_number,
            //   "createdBy"=>$this->'',
        ];
    }
}
