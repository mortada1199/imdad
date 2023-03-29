<?php

namespace App\Http\Services\Settings;

use App\Models\Settings\VehicleBrand;

class BrandService
{


    public  static function store($request)
    {
        $brand = VehicleBrand::create([
            'name_en' => $request->nameEn,
            'name_ar' => $request->nameAr,
        ]);
        return $brand;
    }


    public  static function show($request)
    {
        $brand = VehicleBrand::all();
        return $brand;
    }
}
