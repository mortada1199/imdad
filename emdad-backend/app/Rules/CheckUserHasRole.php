<?php

namespace App\Rules;

use App\Models\UM\role_user;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckUserHasRole implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $role_user = User::where('role_id','=',$value)->count();
        
        if($role_user == 0 ){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute related with user.';
    }
}
