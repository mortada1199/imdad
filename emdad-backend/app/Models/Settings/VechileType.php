<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VechileType extends Model
{
    use HasFactory;
    protected $fillable = ['name_en', 'name_ar'];

}
