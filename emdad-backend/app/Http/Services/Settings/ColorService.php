<?php

namespace App\Http\Services\Settings;

use App\Models\Settings\VechileColor;

class ColorService
{


    public  static function store($request)
    {
        $brand = VechileColor::create([
            'name_en' => $request->nameEn,
            'name_ar' => $request->nameAr,
        ]);
        return $brand;
    }


    public  static function show($request)
    {
        $brand = VechileColor::all();
        return $brand;
    }
}
