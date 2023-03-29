<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryPivotResource extends JsonResource
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
            "id" => $this->category->id??$this->category_id,
            "nameEn" => $this->category->name_en,
            "nameAr" => $this->category->name_ar,
            'status' => $this->status,
            'parentId' => $this->category->parent_id,
            'profileId' => $this->category->profile_id,
            'isleaf' => $this->category->isleaf,
            'type' => $this->category->type,
            'note' =>$this->category->reason,
            'createdAt'=>$this->created_at??null,
            'CeatedBy'=>$this->created_by??null,
            'sequence'=>$this->category->sequence()??''
        
        ];
    }
}
