<?php

namespace App\Http\Controllers\Api;

use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use DisableAuthorization;
    protected $model = Product::class; // or "App\Models\Post"
}
