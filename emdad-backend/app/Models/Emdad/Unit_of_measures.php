<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_of_measures extends Model
{
    use HasFactory;


    protected $fillable = ['id', 'name_ar','name_en','symbol','related_unit','relation','value'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function products()
    {
        return $this->hasMany(Prodcuts::class);
    }
}
