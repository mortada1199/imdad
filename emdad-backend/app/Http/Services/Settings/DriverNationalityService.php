<?php

namespace App\Http\Services\Settings;

use App\Models\Settings\Drivernationality;

class DriverNationalityService
{


    public  static function store($request)
    {
        $nationality = Drivernationality::create([
            'name_en' => $request->nameEn,
            'name_ar' => $request->nameAr,
        ]);
        return $nationality;
    }


    public  static function show($request)
    {
        $nationality = Drivernationality::all();
        return $nationality;
    }
}
