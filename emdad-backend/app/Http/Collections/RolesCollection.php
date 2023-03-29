<?php


namespace App\Http\Collections;

use App\Http\Resources\UMResources\Role\RoleResponse;
use App\Models\UM\Role;
use Illuminate\Support\Str;

use Spatie\QueryBuilder\QueryBuilder;

class RolesCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = ['id','name_en','name_ar','type','permissions_list','for_reg'
        ];
        // $element =  [];
    
            
    //     }
        // $lorem=(Str::camel('permissions_list'));
        // dd($lorem);

        $allowedFilters = [
            'id',
            'name_en',
            'name_ar',
            'type',
            'for_reg',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

    
// dd(convertArrayToCamelCase($defaultSelect));
        $perPage =  $request->pageSize ?? 100;

        return  QueryBuilder::for(Role::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
