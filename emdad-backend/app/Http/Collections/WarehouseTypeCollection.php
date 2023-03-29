<?php


namespace App\Http\Collections;

use App\Models\WarehouseType;
use Spatie\QueryBuilder\QueryBuilder;

class WarehouseTypeCollection
{
public static function collection($request)
    {

        $defaultSort = '-created_at';



        $allowedFilters = [
            "name_en",
            "name_ar",

        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'truckImage'
        ];

        $perPage =  $request->pageSize ?? 20;

        return QueryBuilder::for(WarehouseType::class)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->paginate($perPage);
    }
}
