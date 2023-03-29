<?php

namespace App\Models\UM;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUserProfile extends Pivot
{
    use SoftDeletes;
    protected $fillable = ['permissions','status','is_learning','user_id','created_by','role_id','profile_id','manager_user_Id'];

    protected $table = 'profile_role_user';

    public function users()
    {
        return $this->belongsToMany(User::class, 'profile_role_user', 'user_id')->withTimestamps()->withPivot("status");
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'profile_role_user', 'role_id')->withTimestamps()->withPivot("status");
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_role_user', 'profile_id')->withTimestamps()->withPivot("status");
    }
}
