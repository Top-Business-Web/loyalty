<?php

namespace App\Services\Admin;

//use App\Repositories\ProductRepository;

use App\Models\Product;

class ProductService
{
//    private ProductRepository $product;
//
//    /**
//     * @param ProductRepository $product
//     */
//    public function __construct(ProductRepository $product)
//    {
//        $this->product = $product;
//    }

    public function all()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::find($id);
    }
}
