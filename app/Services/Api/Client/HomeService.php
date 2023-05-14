<?php

namespace App\Services\Api\Client;

use App\Http\Resources\Client\ProvidersResource;
use App\Http\Resources\SliderResource;;

use App\Models\Rate;
use App\Models\Slider;
use App\Models\User;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class HomeService
{
    use DefaultImage,GeneralTrait;
    public function index(){
        $user = auth()->user();
        $providers = User::where('role_id', 1)->get();
        $is_best_providers = User::where(['role_id'=> 1, 'is_best' => '1'])->get();
        $data['the_best_provider'] = ProvidersResource::collection($is_best_providers);
        $data['providers'] = ProvidersResource::collection($providers);
        $data['sliders'] = SliderResource::collection(Slider::all());

        return helperJson($data, '');
    }

    public function search($request){
        $user = auth()->user();
        $providers = User::where('role_id', 1)->get();
        $is_best_providers = User::where(['role_id'=> 1, 'is_best' => '1'])->get();
        $data['the_best_provider'] = ProvidersResource::collection($is_best_providers);
        $data['providers'] = ProvidersResource::collection($providers);
        $data['products'] = SliderResource::collection(Slider::all());

        return helperJson($data, '');
    }

    // add rate to Provider
    public function add_rate($request){
        $rules = [
            'provider_id' => 'required|exists:users,id',
            'value' => 'required',
            'comment' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return helperJson(null, $validator->errors(), 422);
        }
        $user = Auth::guard('api')->user();
        $inputs = request()->all();
        $inputs['client_id'] = $user->id;
        $rate = Rate::create($inputs);
        return helperJson($rate, 'تم التقيم بنجاح');
    }

}
