<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'coupons';
    protected $fillable = [
        'code', 'value', 'is_percentage',
        'start_date', 'end_date', 'allowed', 'used', 'user_id', 'profile_id'
    ];
}
