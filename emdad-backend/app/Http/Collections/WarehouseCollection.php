<?php


namespace App\Http\Collections;

use App\Http\CustomFliters\DefaultWarehousesFilter;
use App\Models\Accounts\Warehouse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class WarehouseCollection
{
public static function collection($request)
    {

        $defaultSort = '-created_at';



        $allowedFilters = [
            'address_name', 'address_contact_phone', 'address_type', 'gate_type', 'created_by',
            'confirm_by',
            AllowedFilter::custom('default', new DefaultWarehousesFilter)->default(auth()->user()),

        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'truckImage'
        ];

        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Warehouse::class)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->with('users.roles')
            ->paginate($perPage);
    }
}
