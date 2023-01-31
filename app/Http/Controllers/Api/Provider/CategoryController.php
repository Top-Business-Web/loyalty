<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    private CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth_jwt');
        $this->categoryService = $categoryService;
    }

    public function index(request $request){
        return $this->categoryService->index($request);
    }

    public function store(request $request){

        return $this->categoryService->store($request);
    }

    public function find(request $request, $id){

        return $this->categoryService->find($request,$id);
    }

    public function update(request $request,$id){

        return $this->categoryService->update($request,$id);
    }

    public function destroy(Request $request,$id)
    {
        return $this->categoryService->destroy($request,$id);
    }//end fun
}
