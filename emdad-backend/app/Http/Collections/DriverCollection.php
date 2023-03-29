<?php


namespace App\Http\Collections;

use App\Models\Accounts\CompanyInfo;
use App\Models\Driver;
use Spatie\QueryBuilder\QueryBuilder;

class DriverCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'id',
            'name_ar',
            'name_en',
            'age',
            'phone',
            'nationality',
            'status'
        ];


        $allowedFilters = [
            'id',
            'name_ar',
            'name_en',
            'age',
            'phone',
            'nationality',
            'status'
        ];

        $allowedSorts = [
            'name_ar',
            'name_en',
        ];

        // $allowedIncludes = [
        //     'users',
        //     'departments',
        // ];

        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Profile::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            // ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
