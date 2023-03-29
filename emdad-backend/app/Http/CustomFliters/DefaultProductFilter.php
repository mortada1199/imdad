<?php


namespace App\Http\CustomFliters;

use App\Models\ProfileCategoryPivot;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DefaultProductFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {

        if ($value) {
            if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                $ProductsId = DB::table('product_profile')->where("profile_id", $value->profile_id)->pluck("product_id");
                $query->whereIn('id', $ProductsId);
            }
        }
    }
}
