<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use PhotoTrait;
    public function index(request $request)
    {
        if($request->ajax()) {
            $product = Product::latest()->get();
            return Datatables::of($product)
                ->addColumn('action', function ($product) {
                    return '
                            <button type="button" data-id="' . $product->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $product->id . '" data-title="' . $product->name_ar . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                              <a class="btn btn-info add-cart" href="#!" product-id="'. $product->id .'" ><i class=" far fa-shopping-cart"></i>add to cart</a>
                       ';
                })
                ->editColumn('user_id', function ($product) {
                    return $product->user->name;
                })
                ->editColumn('name_ar', function ($product) {
                    return $product->name_ar;
                })
                ->editColumn('name_en', function ($product) {
                    return $product->name_en;
                })

                ->editColumn('image', function ($product) {
                    $image = ($product->image);
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="'.$image.'">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/products/index');
        }
    }

    public function categoryProducts(Request $request,$category_id)
    {

        if($request->ajax()) {
            $products = Product::where('category_id',$category_id)->get();

            return Datatables::of($products)
                ->addColumn('action', function ($product) {
                    return '
                            <button type="button" data-id="' . $product->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $product->id . '" data-title="' . $product->name_ar . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })

                ->editColumn('name_ar', function ($product) {
                    return $product->name_ar;
                })
                ->editColumn('name_en', function ($product) {
                    return $product->name_en;
                })
                ->editColumn('image', function ($product) {
                    $image = ($product->image);
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="'.$image.'">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/products/category_products');
        }
    }

    public function create()
    {
        $data['categories'] = Category::latest()->get();
        $data['providers'] = User::where('role_id',1)->get();
        return view('Admin.products.parts.create',$data);
    }


    public function store(Request $request)
    {
        $valiadate = $request->validate([
            'name_ar'     => 'required',
            'name_en'     => 'required',
        ],[
            'name_ar.required' => 'يرجي ادخال  الاسم يالغه الانجليزية',
            'name_en.required' => 'يرجي ادخال الاسم يالغة العربية'
        ]);
        $data = $request->except('_token','image');
        if($request->has('image') && $request->image != null)
            $data['image'] = $this->saveImage($request->image,'assets/uploads/categories','image','100');

        Product::create($data);
        return response()->json(['status' => 200]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['find'] = Product::find($id);
         $data['categories'] = Category::latest()->get();
        $data['providers'] = User::where('role_id',1)->get();
        return view('Admin.products.parts.edit',$data);
    }



    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->except('_token','_method','image');



        if($request->has('image') && $request->image != null){
            if (file_exists($product->getAttributes()['image'])) {
                unlink($product->getAttributes()['image']);
            }
            $data['image'] = $this->saveImage($request->image,'assets/uploads/products');
        }

        $product->update($data);
        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,$id)
    {
        $product = Product::findOrFail($request->id);
        if (file_exists($product->getAttributes()['image'])) {
            unlink($product->getAttributes()['image']);
        }
        $product->delete();
        return response(['message'=>'تم الحذف بنجاح','status'=>200],200);
    }


    public function show_product()
    {
        $product_id = request()->get('product_id');
        $product = Product::find($product_id);
        $html = view('admin.pages.components.product-details', compact('product'))->render();
        return response()->json(['html' => $html]);
    }
}
