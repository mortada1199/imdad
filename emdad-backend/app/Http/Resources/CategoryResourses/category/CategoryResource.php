<?php

namespace App\Http\Resources\CategoryResourses\category;

use App\Models\Emdad\Category;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $user = DB::table('category_profile')->where('profile_id',auth()->user()->profile_id)->where("user_id",$this->created_by)->first();
        // $user = $this->profiles()->where('profile_id',auth()->user()->profile_id)->where("user_id",$this->created_by)->first()->profile;
        // dd($user);
        return [
            "id" => $this->id,
            "nameEn" => $this->name_en,
            "nameAr" => $this->name_ar,
            'status' => $this->status,
            'parentId' => $this->parent_id,
            'profileId' => $this->profile_id,
            'isleaf' => $this->isleaf,
            'type' => $this->type,
            'note' => $this->reason,
            "setCategoryStatus" => $this->addedToProfile()->status ?? '',
            'createdAt' => $this->created_at != null ? $this->created_at->format('y-m-d') : null,
            'addedToProfileAt' => $this->addedToProfile() ? date('y-m-d',strtotime($this->addedToProfile()->created_at)) : null,
            'CreatorName' => $this->addedToProfile() != null ? User::where("id", $this->addedToProfile()->user_id)->first()->full_name : 'Created By Emdad',
            // 'CreatorName' => $this->CreatorName()!=null?User::where("id", $this->CreatorName()->user_id)->first()->full_name:'',
            'sequence' => $this->sequence() ?? "debug"
        ];
    }
}
