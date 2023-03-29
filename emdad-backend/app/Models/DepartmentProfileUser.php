<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentProfileUser extends Pivot
{
    use SoftDeletes;
    protected $table ='profile_department_user';
    public function users(){
        return $this->belongsToMany(User::class,'profile_department_user','users_id')->withTimestamps()->withPivot("status");
    }
    
    public function departments(){
        return $this->belongsToMany(Role::class,'profile_department_user','department_id')->withTimestamps()->withPivot("status");
    }
    
    public function profiles(){
        return $this->belongsToMany(CompanyInfo::class,'profile_department_user','profile_id')->withTimestamps()->withPivot("status");
    }
}
