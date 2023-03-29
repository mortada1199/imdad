<?php

namespace App\Http\Resources\CategoryResourses\Product;

use App\Models\Emdad\Categories;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResponse extends JsonResource
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
            "nameEn" => $this->name_en,
            "nameAr" => $this->name_ar,
            "price" => $this->price,
            'descriptionEn' => $this->description_en,
            'descriptionAr' => $this->description_ar,
            'measruingUnit' => $this->measruing_unit,
            'profileId' => $this->profile_id,
            'categoryId' => $this->category_id,
            "categoryType" => $this->category->type ?? '',
            'creatorName' => $this->creatorName()->full_name,
            "ProductsImages" => $this->getMedia('products'),
            "CategorySequence" => $this->category->sequence() ?? null,
            "createdAt" => $this->created_at->format("y-m-d"),
        ];
    }
}
