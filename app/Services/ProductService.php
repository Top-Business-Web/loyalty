<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    use DefaultImage,GeneralTrait;
    public function index($request,$category_id){
        $user = auth()->user();
        $products = Product::where(['user_id'=> $user->id, 'category_id'=> $category_id])->get();

        return helperJson(ProductResource::collection($products), '');

    }

    public function store( $request){

        $rules = [
            'name_ar' => 'required|min:2|max:191',
            'name_en' => 'required|min:2|max:191',
            'price' => 'required',
            'price_after_discount' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return helperJson(null, $validator->errors(), 422);
        }
        $user = auth()->user();
        $inputs = request()->all();
        $inputs['image'] = '';
        if ($request->hasFile('image')) {
            $inputs['image'] = $this->uploadFiles('products', $request->file('image'));
        }
        $inputs['user_id'] = $user->id;
        $product = Product::create($inputs);
        return helperJson(new ProductResource($product), 'تمت الاضافة بنجاح');
    }

    public function find($request, $id)
    {
        $product = Product::find($id);

        return helperJson($product, '',200);
    }//end fun

    public function update( $request,$id){

        $rules = [
            'name_ar' => 'required|min:2|max:191',
            'name_en' => 'required|min:2|max:191',
            'price' => 'required',
            'price_after_discount' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return helperJson(null, $validator->errors(), 422);
        }

        $inputs = request()->all();
        $inputs['image'] = '';
        if ($request->hasFile('image')) {
            $inputs['image'] = $this->uploadFiles('products', $request->file('image'));
        }
        $product = Product::find($id)->update($inputs);

        return helperJson($product, 'تمت التعديل بنجاح');
    }

    public function destroy( $request, $id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return helperJson(null, 'تمت الحذف بنجاح');
        }else {
            return helperJson(null, 'هذا العنصر غير موجود',402,200);
        }
    }//end fun
}
