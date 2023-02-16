<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\Client\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    /**
     * @param productService $productService
     */
    public function __construct(ProductService $productService)
    {
//        $this->middleware('auth_jwt');
        $this->productService = $productService;
    }

    public function index(request $request, $id){
        return $this->productService->productsByCategoryId($request, $id);
    }
}
