<?php


namespace App\Http\CustomFliters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DefaultWarehousesFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value) {
            if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                 $query->where('profile_id',$value->profile_id);
            }
        }
    }
}
