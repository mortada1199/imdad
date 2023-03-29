<?php

namespace App\Http\Services\General;

use App\Models\AppSetting;


class AppSettingsService
{

    public function store($request)
    {

        return AppSetting::updateOrCreate(['key' => $request['key']], ['value' => $request['value']]);
    }
}
