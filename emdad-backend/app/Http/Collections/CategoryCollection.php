<?php


namespace App\Http\Collections;

use App\Http\CustomFliters\DefaultCategoryFilter;
use App\Models\Emdad\Category;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryCollection
{
    public static function collection($request)
    {
    

        $defaultSort = '-created_at';

        $value = ["profile_id" => auth()->user()->profile_id, "onlyRequested" => isset($request->onlyRequested) ? true : false];

        $allowedFilters = [
            'name_en',
            'name_ar',
            'parent_id',
            'isleaf', 
            'type',
            'status',
            'profile_id',
            'reason',
            AllowedFilter::custom('default', new DefaultCategoryFilter)->default($value),
            AllowedFilter::exact('parent_id'),
            AllowedFilter::exact('profile_id'),
            AllowedFilter::exact('name_en'),
            AllowedFilter::exact('type'),
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'Products',
        ];

        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Category::class)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
