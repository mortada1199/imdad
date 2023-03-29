<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPackages extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = [
        'package_id', 'package_name_en','type' , 'package_name_ar','features','price_1','price_2','free_first_time'
    ];
}
