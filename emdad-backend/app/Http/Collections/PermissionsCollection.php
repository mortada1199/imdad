<?php


namespace App\Http\Collections;

// use App\Models\Emdad\Categories;
use App\Models\UM\Permission;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionsCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'name', 'label','category','description'
        ];


        $allowedFilters = [
            'name', 'label','category','description'
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];


        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Permission::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
