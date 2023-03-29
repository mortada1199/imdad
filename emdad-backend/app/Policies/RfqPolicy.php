<?php

namespace App\Policies;

use App\Models\rfq\Rfq;
use App\Models\UM\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RfqPolicy
{
    
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RFQ $rfq
     * @return mixed
     */
    public function view(User $user)
    {
        $permission = Permission::where('name', 'rfq_view')->first();
        return $user->hasRole($permission->roles);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permission = Permission::where('name', 'rfq_add')->first();
        return $user->hasRole($permission->roles);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RFQ $rfq
     * @return mixed
     */
    public function update(User $user)
    {
        $permission = Permission::where('name', 'rfq_edit')->first();
        return $user->hasRole($permission->roles);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RFQ $rfq
     * @return mixed
     */
    public function delete(User $user)
    {
        $permission = Permission::where('name', 'rfq_delete')->first();
        return $user->hasRole($permission->roles);
    }

    public function check_record(User $user, $rfq)
    {
        return $user->id === $rfq->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RFQ $rfq
     * @return mixed
     */
    public function restore(User $user,Rfq $rfq)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RFQ $rfq
     * @return mixed
     */
    public function forceDelete(User $user, RFQ$rfq)
    {
        //
    }

}
