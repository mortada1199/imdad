<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_types extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function product_attachment()
    {
        return $this->belongsTo(Products_attachment::class);
    }
}
