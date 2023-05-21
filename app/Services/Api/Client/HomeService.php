<?php

namespace App\Services\Api\Client;

use App\Http\Resources\Client\ProvidersResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;;

use App\Models\Package;
use App\Models\Product;
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

    public function packages(){

        $data['packages'] = Package::select('id','price','title','description')->get();

        return helperJson($data, '');
    }

    public function search($request){
        $search_key = $request->search_key;
//        dd($request->provider_id);
        $products = Product::where('user_id',$request->provider_id)
            ->where(function ($query) use ($search_key) {
                $query->where('name_ar', 'LIKE', '%'.$search_key.'%')
                    ->orWhere('name_en', 'LIKE', '%'.$search_key.'%');
            })->get();
        return helperJson(ProductResource::collection($products), '',200);
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
        $rate = Rate::where(['client_id'=>$user->id,'provider_id'=>$inputs['provider_id']]);
        if($rate->count()){
            $rate = $rate->first();
            $rate->value = $inputs['provider_id'];
            $rate->comment = $inputs['comment'];
            $rate->save();
        }else {
            $rate = Rate::create($inputs);
        }
        return helperJson($rate, 'تم التقيم بنجاح');
    }

}
