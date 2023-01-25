<?php

namespace App\Services\Api\Client;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use function auth;
use function helperJson;
use function request;

class CategoryService
{
    use DefaultImage,GeneralTrait;
    public function productsByCategoryId($request,$id){
        $user = auth()->user();
        $products = Product::where('category_id', $id)->get();

        return helperJson(ProductResource::collection($products), '');

    }


}
