<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_tx extends Model
{
    use HasFactory;
    protected $fillable =['amount','type','provider','status','ref_id','gateway_tx_id'];

    
}
