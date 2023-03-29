<?php

namespace App\Models;

use App\Models\Accounts\SubscriptionPackages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{
    use HasFactory;
    protected $tabel = 'subscription_payments';

    protected $fillable = ['profile_id', 'package_id', 'user_id', 'sub_total', 'tax_amount', 'total', 'discount', 'tx_id', 'status', 'coupon_id', 'expire_date'];

    public function package()
    {
        return $this->belongsTo(SubscriptionPackages::class, 'package_id');
    }

}
