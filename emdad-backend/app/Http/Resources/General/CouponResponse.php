<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResponse extends JsonResource
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
            'allowed'=>$this->allowed,
            'startDate'=>$this->start_date,
            'endDate'=>$this->end_date,
            'value'=>$this->value,
            'isPercentage'=>$this->is_percentage,
            'code'=>$this->code
        ];
    }
}
