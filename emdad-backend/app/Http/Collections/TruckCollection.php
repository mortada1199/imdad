<?php


namespace App\Http\Collections;

use App\Models\Accounts\Truck;
use Spatie\QueryBuilder\QueryBuilder;

class TruckCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'id', 'name','type', 'class', 'color', 'model','size', 'brand', 'status', 'created_by', 'status', 'plate_number'
        ];


        $allowedFilters = [
            'id', 'name','type', 'class', 'color', 'model','size', 'brand', 'status', 'created_by', 'status', 'plate_number'
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'truckImage'
        ];

        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Truck::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
