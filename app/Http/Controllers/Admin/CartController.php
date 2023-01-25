<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProductService;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private ProductService $product;

    /**
     * @param ProductService $product
     */
    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }

    public function get_one_cart_($id)
    {
        return get_one_cart($id);
    }

    public function get_cart_()
    {
        $cartCollections = Cart::getContent();
        return $cartCollections;
    }

    public function get_cart()
    {
        $cartCollections = Cart::getContent()->values();
//        return $cartCollections;
        return view('Admin.cart.index')->with(['cartCollections' => $cartCollections]);
    }
    public function cart_table()
    {
        $cartCollections = Cart::getContent()->values();
//        return $cartCollections;
        return view('Admin.cart.components.cart_table')->with(['cartCollections' => $cartCollections]);
    }



    public function get_ajax_cart($id)
    {

        $price_id = Cart::get($id)['id'];

        return response([
            'status' => true,
            'single_total_price' => get_single_cart_price($price_id),
            'total' => cart_total_price(),
            'message' => trans('web_lang.Item Updated To Cart Successfully')
        ]);


    }

    public function get_header_cart()
    {
        $cart_products = [];
        foreach (cart_content() as $product_) {
            $product = Product::find($product_->product_id);
            $cart_products_['id'] = $product->id;
            $cart_products_['image'] = $product->image;
            $cart_products_['title'] = get_lang() == 'ar' ? $product->name_ar : $product->name_en;
            $cart_products_['price'] = curreny_price($product->price, $product->price);
            $cart_products_['quantity'] = Cart::get($product_->id)['quantity'];
            $cart_products[] = $cart_products_;
        }
        return response([
            'status' => true,
            'total_items' => Cart::getContent()->count(),
            'cart_content' => cart_content(),
            'cart_total_price' => cart_total_price(),
            'total' => cart_total_price(),
            'cart_products' => $cart_products,
            'message' => trans('web_lang.Item Added To Cart Successfully')
        ]);
    }

    public function send_cart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $product = $this->product->find($product_id);
        Cart::add(array(
            'id' => $product_id,
            'name' => $product->name_ar,
            'price' => (int)$product->price,
            'quantity' => (int)$quantity,
            'attributes' => array(
                'product_id' => $product_id,
                'image' => $product->image,
            )
        ));

        return response(['status' => true,
            'cart_count' => cart_views()->count(),
            'total_price' => Cart::getTotal(),
            'result' => cart_views(),
            'title' =>'web_lang.message',
            'message' =>'web_lang.Item Added To Cart Successfully'
        ]);

    }

    public function update_cart(Request $request)
    {
        $get_qty = Cart::get($request->product_id)->quantity;

        Cart::update($request->product_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));

        return response([
            'status' => true,
            'cart_count' => cart_counts(),
            'total_price' => number_format((float)cart_get_total(), 2, '.', ''),
            'title' => trans('web_lang.message'),
            'message' => trans('web_lang.Item Updated To Cart Successfully')
        ]);
    }

    public function delete_cart(Request $request)
    {
        Cart::remove($request->product_id);
        toastr()->success('تم الحذف بنجاح');
        return back();
    }

}
