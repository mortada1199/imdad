<?php

namespace App\Http\Services\Settings;

use App\Models\Settings\Setting;

class SettingsService
{

    public function store($request)
    {
        return Setting::updateOrCreate(['user_id' => auth()->id()], ['profile_id' => auth()->user()->profile_id, 'preferences' => json_encode($request['preferences'], true)]);
    }
}
