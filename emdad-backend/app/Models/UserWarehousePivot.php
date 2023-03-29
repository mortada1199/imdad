<?php

namespace App\Models;

use App\Models\Accounts\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWarehousePivot extends Model
{
    use SoftDeletes;
    protected $table = 'user_warehouse_pivots';
    protected $fillable = ['user_id','warehouse_id','status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'user_warehouse_pivots', 'warehouse_id')->withTimestamps()->withPivot("status");
    }



}
