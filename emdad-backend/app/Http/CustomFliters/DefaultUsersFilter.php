<?php


namespace App\Http\CustomFliters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DefaultUsersFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value) {
            if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                 $query->Join('profile_role_user', 'profile_role_user.user_id', '=', 'users.id')->where('profile_role_user.profile_id', $value->profile_id)->select('users.*');
            }
        }
    }
}
