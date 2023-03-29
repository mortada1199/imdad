<?php

namespace App\Models\UM;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $tabel = 'roles';
    protected $fillable = ['name_en','name_ar','type','permissions_list','for_reg'];


    // public function givePermissionTo(RolePermission $permission)
    // {
    //     return $this->permissions()->save($permission);
    // }
    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    // public function hasPermission(RolePermission $permission)
    // {
    //     return $this->hasRole($permission->roles);
    // }
    /**
     * Determine if the role has the given permission.
     *
     * @param  mixed $permission
     * @return boolean
     */

     // role users
     public function users()
     {
         return $this->belongsToMany(User::class, 'profile_role_user')
         ->withPivot(['user_id', 'status'])
         ->as('user');
     }
    
    // role profiles
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_role_user')
        ->withPivot(['profile_id', 'status'])
        ->as('profile');;
    }

}
