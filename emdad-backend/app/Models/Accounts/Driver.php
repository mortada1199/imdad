<?php

namespace App\Models\Accounts;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name_ar','name_en', 'age', 'phone', 'nationality', 'status','user_id','profile_id'
    ];

    public function manageable () {
        return $this->morphTo();
    }


    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class)->withTimestamps();
    }
}
