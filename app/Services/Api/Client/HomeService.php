<?php

namespace App\Services\Api\Client;

use App\Http\Resources\Client\ProvidersResource;
use App\Http\Resources\SliderResource;;

use App\Models\Slider;
use App\Models\User;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;

class HomeService
{
    use DefaultImage,GeneralTrait;
    public function index(){
        $user = auth()->user();
        $providers = User::where('role_id', 1)->get();
        $is_best_providers = User::where(['role_id'=> 1, 'is_best' => '1'])->get();
        $data['the_best_provider'] = ProvidersResource::collection($is_best_providers);
        $data['providers'] = ProvidersResource::collection($providers);
        $data['sliders'] = SliderResource::collection(Slider::all());;

        return helperJson($data, '');
    }
}
