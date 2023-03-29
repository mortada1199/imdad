<?php


namespace App\Http\CustomFliters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DefaultProfilesFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value) {
            if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                $query->where('id', $value->profile_id);
            }
        }
    }
}
