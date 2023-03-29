<?php

namespace App\Models\Emdad;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    
    use HasFactory, SoftDeletes , LogsActivity,InteractsWithMedia;
    protected $table = "products";
    protected $fillable = ['created_by','profile_id','name_en','name_ar','description_en','description_ar', 'measruing_unit', 'category_id', 'price'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }
    public function category()
    {
        // return $this->belongsTo(Categories::class);
        return $this->belongsTo(Category::class);
    }


    public function unit_measruing()
    {
        return $this->belongsTo(unit_measruing::class,'measruing_unit');
    }

    public function companyProduct()
    {
        return $this->belongsToMany(Profile::class, 'product_profile', 'profile_id', 'product_id')
            ->withPivot('product_id')
            ->withTimestamps();
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
    // public function productattachment()
    // {
    //     return $this->belongsToMany(Profile::class, 'products_attachment_pivot', 'product_id', 'image_path')
    //         ->withPivot('product_id')
    //         ->withTimestamps();
    // }

    public function CreatorName()
    {
        return User::where('id',$this->created_by)->first();
        
    }

    

}
