<?php

namespace App\Policies;

// use App\Models\Emdad\Categories;

use App\Http\Services\General\CheckService;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class  CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Model)$categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
       return CheckService::checkTwoTypes($user, $type1 = "BMCT4", $type2 = "SMCT4");
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
       return CheckService::checkTwoTypes($user, $type1 = "BMT1", $type2 = "SMT1");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)    {
    //    return CheckService::checkTwoTypes($user, $type1 = "BMCT2", $type2 = "SMCT2");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)    {
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)    {
        //
    }
}
