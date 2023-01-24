<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function index(request $request){

        if($request->ajax()) {
            $orders = Order::latest()->get();
            return Datatables::of($orders)
                ->addColumn('action', function ($orders) {


                    return '
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $orders->id . '" data-title="' . ($orders->user->name) ??'' . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                             <button onclick="cancel(' .$orders->id. ')" class="btn btn-pill btn-info"
                                    data-id="' . $orders->id . '" >
                                    الغاء
                            </button>
                       ';
                })
                ->addColumn('details', function ($orders) {
                    $details='لم يتم اتمام الطلب بعد';
                    if($orders->status=='new' || $orders->status=='on_way' || $orders->status=='accepted' || $orders->status=='delivered')
                        $details= '<button type="button" data-id="' . $orders->id . '" class="btn btn-pill btn-default detailsBtn"> عرض</button>';
                    return $details;
                })
                ->addColumn('invoice', function ($orders) {
                    $invoice= 'لم يتم اتمام الطلب بعد';
                    if($orders->status=='new'||$orders->status=='preparing' || $orders->status=='on_way' || $orders->status=='delivered')
                        $invoice= '<button type="button" data-id="' . $orders->id . '" onclick="invoice('.$orders->id.')" class="btn btn-pill btn-default invoice-btn"   > الفاتورة</button>';

                    return $invoice;

                })
                ->editColumn('id', function ($order) {

                    $id=$order->id ;

//                    if(strlen($order->id)==1)
//                        $id='ORD-00000'. $order->id ;
//                    elseif(strlen($order->id)==2)
//                        $id= 'ORD-0000' . $order->id ;
//                    elseif(strlen($order->id)==3)
//                        $id= 'ORD-000' .$order->id ;
//                    elseif(strlen($order->id)==4)
//                        $id= 'ORD-00'. $order->id ;
//
//                    elseif(strlen($order->id)==5)
//                        $id= 'ORD-0'. $order->id ;
//                    else
//                    {
                        $id='ORD-'.$order->id;
//                    }


                    return "$id";
                })
                ->editColumn('user_id', function ($orders) {
//                    $url  = route('clientProfile',$orders->user->id);
                    $name = ($orders->user->name) ?? '';
//                    if(!checkPermission(19))
                        return "<a class='text-dark fw-bold'  >$name</a>";

//                    return "<a class='text-dark fw-bold'  href = '".$url."'>$name</a>";
                })
                ->addColumn('phone', function ($orders) {
                    $phone = $orders->user->phone;
                    return '<a href = "tel:'.$phone.'"> '.$phone.'</a>';
                })

                ->editColumn('created_at', function ($orders) {
                    return $orders->created_at->diffForHumans();
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/orders/new-orders');
        }
    }
    public function store(Request $request)
    {
        $cartCollections = Cart::getContent()->values();
        $data['provider_id'] = Auth()->user()->id;
        $data['user_id'] = 1;
        $data['total_price'] = cart_get_total();
        $order = Order::create($data);
        $order_details = [];
        foreach($cartCollections as $cartCollection){
            $order_details[$cartCollection['id']]['order_id'] =  $order->id;
            $order_details[$cartCollection['id']]['product_id'] =  $cartCollection['id'];
            $order_details[$cartCollection['id']]['qty'] =  $cartCollection['quantity'];
            $order_details[$cartCollection['id']]['user_id'] =  1;
        }
        $order->details()->createMany($order_details);
        Cart::clear();
        return redirect()->back()->with('success', 'تم حفظ الطلب');

    }
}
