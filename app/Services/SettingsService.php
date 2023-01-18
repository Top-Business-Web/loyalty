<?php

namespace App\Services;

use App\Http\Resources\SettingResource;
use App\Models\Setting;

class SettingsService
{
    public function getAll()
    {
        $data = new SettingResource(Setting::first());
        return response()->json(['data' => $data], 200);
    }
}
