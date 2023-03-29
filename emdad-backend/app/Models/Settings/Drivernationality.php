<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivernationality extends Model
{
    use HasFactory;
    protected $fillables = ['name_en' , 'name_ar'];
}
