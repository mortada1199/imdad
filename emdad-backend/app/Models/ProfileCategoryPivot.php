<?php

namespace App\Models;

// use App\Models\Emdad\Categories;
use App\Models\Emdad\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileCategoryPivot extends Model
{
use SoftDeletes,HasFactory;
    protected $table = 'profile_category_pivots';
    protected $fillable = ['profile_id','category_id','status','user_id'];


    public function category()
    {
        // return $this->belongsToMany(Categories::class, 'id');
        return $this->belongsToMany(Category::class,);
    }

}
