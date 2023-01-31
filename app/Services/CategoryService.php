<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
    use DefaultImage,GeneralTrait;
    public function index(){
        $user = auth()->user();
        $categories = Category::where('user_id', $user->id)->get();

        return helperJson(CategoryResource::collection($categories), '');

    }

    public function store($request){

        $rules = [
            'name_ar' => 'required|min:2|max:191',
            'name_en' => 'required|min:2|max:191',
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
            $inputs['image'] = $this->uploadFiles('categories', $request->file('image'));
        }
        $inputs['user_id'] = $user->id;
        $category = Category::create($inputs);
        return helperJson(new CategoryResource($category), 'تمت الاضافة بنجاح');
    }

    public function find($request, $id)
    {
        $category = Category::find($id);

        return helperJson($category, '',200);
    }//end fun

    public function update($request,$id){

        $rules = [
            'name_ar' => 'required|min:2|max:191',
            'name_en' => 'required|min:2|max:191',
            'image' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return helperJson(null, $validator->errors(), 422);
        }

        $inputs = request()->all();
        $inputs['image'] = '';
        if ($request->hasFile('image')) {
            $inputs['image'] = $this->uploadFiles('categories', $request->file('image'));
        }
        $category = Category::find($id)->update($inputs);

        return helperJson($category, 'تمت التعديل بنجاح');
    }

    public function destroy($request, $id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return helperJson(null, 'تمت الحذف بنجاح');
        }else {
            return helperJson(null, 'هذا العنصر غير موجود',402,200);
        }
    }//end fun
}
