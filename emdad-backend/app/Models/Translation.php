<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;


    protected $tabel = 'translations';

    protected $fillable = ['key','ar_value','en_value'];

}
