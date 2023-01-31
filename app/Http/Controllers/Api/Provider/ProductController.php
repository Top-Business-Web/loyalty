<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $productService;

    /**
     * @param productService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->middleware('auth_jwt');
        $this->productService = $productService;
    }

    public function index(request $request,$category_id){
        return $this->productService->index($request,$category_id);
    }

    public function store(request $request){

        return $this->productService->store($request);
    }

    public function find(request $request, $id){

        return $this->productService->find($request,$id);
    }

    public function update(request $request,$id){

        return $this->productService->update($request,$id);
    }

    public function destroy(Request $request,$id)
    {
        return $this->productService->destroy($request,$id);
    }//end fun
}
