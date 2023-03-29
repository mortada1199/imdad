<?php

namespace App\Policies;

use App\Http\Services\General\CheckService;
use App\Models\Emdad\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class ProductPolicy
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
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return CheckService::checkTwoTypes($user, $type1 = "BMP4", $type2 = "SMP4");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return CheckService::checkTwoTypes($user, $type1 = "BMP1", $type2 = "SMP1");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Product $Product)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Product $Product)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $Product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $Product)
    {
        //
    }
}
