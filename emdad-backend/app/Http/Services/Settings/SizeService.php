<?php

namespace App\Http\Services\Settings;

use App\Models\Settings\VechileSize;

class SizeService
{


    public  static function store($request)
    {
        $size = VechileSize::create([
            'name_en' => $request->nameEn,
            'name_ar' => $request->nameAr,
        ]);
        return $size;
    }


    public  static function show($request)
    {
        $size = VechileSize::all();
        return $size;
    }
}
