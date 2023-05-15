<?php

namespace App\Services\Api\Client;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use function auth;
use function helperJson;
use function request;

class ProductService
{
    use DefaultImage,GeneralTrait;
    public function productsByCategoryId($request,$id){
//        $user = auth()->user();
        $data['the_best'] = ProductResource::collection(Product::where(['category_id'=> $id,'the_best'=> '1'])->get());
        $data['products'] = ProductResource::collection(Product::where('category_id', $id)->get());

        return helperJson($data, '');

    }
}
