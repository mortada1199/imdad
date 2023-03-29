<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name','profile_id'];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'company_info_department_user'
        )->withPivot('company_info_id')
        ->withTimestamps();

        ;
    }

    public function compnies()
    {
        return $this->belongsToMany(
            CompanyInfo::class,
            'company_info_department_user'
        )->withPivot('user_id')
        ->withTimestamps();

        ;
    }
}
