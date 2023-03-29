<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedCompanies extends Model
{
    use HasFactory;
    protected $fillable = ['cr_number','business_type','relation','identity','identity_type'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
