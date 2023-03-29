<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck_image extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'truck_id'
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
