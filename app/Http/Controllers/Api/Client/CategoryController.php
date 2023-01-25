<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\Client\CategoryService;
use Illuminate\Http\Request;

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




}
