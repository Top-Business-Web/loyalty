<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Setting;


class SettingController extends Controller
{
    use GeneralTrait;

    public function setting(){
        $data = Setting::first();
        return helperJson($data);
    }

}
