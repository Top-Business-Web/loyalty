<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class OrderController extends Controller
{
    public function newOrders(request $request){

        if($request->ajax()) {
            $orders = Order::latest()->get();
            return Datatables::of($orders)
                ->addColumn('action', function ($orders) {
                    return '<button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $orders->id . '" data-title="' . @$orders->user->name . '">
                                    <i class="fas fa-trash"></i>
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
                ->editColumn('provider_id', function($orders) {
                    return '<td>'. $orders->provider->name .'</td>';
                })
                ->editColumn('category_id', function($orders) {
                    if($orders->provider->provider_type == 1)
                    {
                        return '<td>مطعم</td>';
                    }
                    else
                    {
                        return '<td>كافيه</td>';
                    }
                })
                ->editColumn('id', function ($orders) {

                    $id=$orders->id ;

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
                        $id='ORD-'.$orders->id;
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

    public function currentOrders(request $request){
        if(!checkPermission(56))
            return view('Admin.permission');
        if($request->ajax()) {

            $orders = Order::whereIn('status',['accepted','offered','preparing','on_way'])->latest()->get();
            return Datatables::of($orders)
                ->addColumn('details', function ($orders) {
                    $details='لم يتم اتمام الطلب بعد';
                    if($orders->status=='preparing' || $orders->status=='on_way' || $orders->status=='accepted' || $orders->status=='delivered')
                        $details= '<button type="button" data-id="' . $orders->id . '" class="btn btn-pill btn-default detailsBtn"> عرض</button>';
                    return $details;
                })
                ->editColumn('user_id', function ($orders) {
                    $url  = route('clientProfile',$orders->user->id);
                    $name = ($orders->user->name) ??'';
                    if(!checkPermission(19))
                        return "<a class='text-dark fw-bold'  >$name</a>";
                    return "<a class='text-dark fw-bold'  href = '".$url."'>$name</a>";
                })
                ->addColumn('phone', function ($orders) {
                    $phone = $orders->user->phone_code.$orders->user->phone??'';
                    return '<a href = "tel:'.$phone.'"> '.$phone.'</a>';
                })
                ->editColumn('created_at', function ($orders) {
                    return $orders->created_at->diffForHumans();
                })
                ->addColumn('invoice', function ($orders) {
                    $invoice= 'لم يتم اتمام الطلب بعد';
                    if($orders->status=='accepted'||$orders->status=='preparing' || $orders->status=='on_way' || $orders->status=='delivered')
                        $invoice= '<button type="button" data-id="' . $orders->id . '" onclick="invoice('.$orders->id.')" class="btn btn-pill btn-default invoice-btn"   > الفاتورة</button>';

                    return $invoice;

                })
                ->editColumn('address', function ($orders) {
                    $string=Str::limit($orders->address->address??'', 50);

                    return $string ;

                })
                ->editColumn('id', function ($order) {

                    $id=$order->id ;

                    if(strlen($order->id)==1)
                        $id='ORD-00000'. $order->id ;
                    elseif(strlen($order->id)==2)
                        $id= 'ORD-0000' . $order->id ;
                    elseif(strlen($order->id)==3)
                        $id= 'ORD-000' .$order->id ;
                    elseif(strlen($order->id)==4)
                        $id= 'ORD-00'. $order->id ;

                    elseif(strlen($order->id)==5)
                        $id= 'ORD-0'. $order->id ;
                    else
                    {
                        $id='ORD-'.$order->id;
                    }


                    return "$id";
                })
                ->editColumn('status', function ($orders) {
                    $name = ($orders->provider->name) ?? '-';
                    if($orders->status == 'accepted')
                        return '<span class="badge badge-default">  تم قبول العرض</span>';
                    elseif ($orders->status == 'offered')
                        return '<span class="badge badge-warning">  تم تقديم عرض</span>';
                    elseif ($orders->status == 'preparing')
                        return '<span class="badge badge-success">جاري التحضير</span><br> بواسطة المقدم '.$name;
                    elseif ($orders->status == 'cancel')
                        return '<span class="badge badge-warning">    تم الالغاء</span>';
                    elseif ($orders->status == 'new')
                        return '<span class="badge badge-warning">    جديد</span>';
                    elseif ($orders->status == 'rejected')
                        return '<span class="badge badge-warning">  تم رفض الطلب</span>';
                    elseif ($orders->status == 'delivered')
                        return '<span class="badge badge-warning">     تم التوصيل</span>';
                    elseif ($orders->status == 'on_way')
                        return '<span class="badge badge-warning">    في الطريق</span>';

                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/orders/current-orders');
        }
    }

    public function endedOrders(request $request){
        if(!checkPermission(58))
            return view('Admin.permission');
        if($request->ajax()) {
            $orders = Order::whereIn('status',['rejected','delivered','cancel'])->latest()->get();
            return Datatables::of($orders)
                ->addColumn('details', function ($orders) {
                    $details='لم يتم اتمام الطلب بعد';
                    if($orders->status=='preparing' || $orders->status=='on_way' || $orders->status=='accepted' || $orders->status=='delivered')
                        $details= '<button type="button" data-id="' . $orders->id . '" class="btn btn-pill btn-default detailsBtn"> عرض</button>';
                    return $details;
                })
                ->addColumn('bill', function ($orders) {
                    if($orders->status == 'cancel' || $orders->status == 'rejected')
                        return "<span class='badge badge-danger fw-bold'>تم الالغاء</span>";
                    else{
                        $url  = route('orderBill',$orders->id);
                        return "<a class='text-dark fw-bold'  href = '".$url."'><i class='fe fe-file-text'></i></a>";
                    }
                })
                ->addColumn('invoice', function ($orders) {
                    $invoice= 'لم يتم اتمام الطلب بعد';
                    if($orders->status=='accepted'||$orders->status=='preparing' || $orders->status=='on_way' || $orders->status=='delivered')
                        $invoice= '<button type="button" data-id="' . $orders->id . '" onclick="invoice('.$orders->id.')" class="btn btn-pill btn-default invoice-btn"   > الفاتورة</button>';

                    return $invoice;

                })
                ->editColumn('user_id', function ($orders) {
                    $url  = route('clientProfile',$orders->user->id);
                    $name = ($orders->user->name) ?? '';
                    if(!checkPermission(19))
                        return "<a class='text-dark fw-bold'  >$name</a>";
                    return "<a class='text-dark fw-bold'  href = '".$url."'>$name</a>";
                })
                ->addColumn('phone', function ($orders) {
                    $phone = $orders->user->phone_code.$orders->user->phone??'';
                    return '<a href = "tel:'.$phone.'"> '.$phone.'</a>';
                })
                ->editColumn('created_at', function ($orders) {
                    return $orders->created_at->diffForHumans();
                })
                ->editColumn('address', function ($orders) {
                    $string=Str::limit($orders->address->address??'', 50);
                    return $string ;
                })
                ->editColumn('id', function ($order) {

                    $id=$order->id ;

                    if(strlen($order->id)==1)
                        $id='ORD-00000'. $order->id ;
                    elseif(strlen($order->id)==2)
                        $id= 'ORD-0000' . $order->id ;
                    elseif(strlen($order->id)==3)
                        $id= 'ORD-000' .$order->id ;
                    elseif(strlen($order->id)==4)
                        $id= 'ORD-00'. $order->id ;

                    elseif(strlen($order->id)==5)
                        $id= 'ORD-0'. $order->id ;
                    else
                    {
                        $id='ORD-'.$order->id;
                    }


                    return "$id";
                })
                ->editColumn('status', function ($orders) {
                    if($orders->status == 'accepted')
                        return '<span class="badge badge-default">  تم قبول العرض</span>';
                    elseif ($orders->status == 'offered')
                        return '<span class="badge badge-warning">  تم تقديم عرض</span>';
                    elseif ($orders->status == 'preparing')
                        return '<span class="badge badge-success">جاري التحضير</span><br> بواسطة المقدم '.($orders->provider->name) ?? '';
                    elseif ($orders->status == 'cancel')
                        return '<span class="badge badge-warning">    تم الالغاء</span>';
                    elseif ($orders->status == 'new')
                        return '<span class="badge badge-warning">    جديد</span>';
                    elseif ($orders->status == 'rejected')
                        return '<span class="badge badge-warning">  تم رفض الطلب</span>';
                    elseif ($orders->status == 'delivered')
                        return '<span class="badge badge-warning">     تم التوصيل</span>';
                    elseif ($orders->status == 'on_way')
                        return '<span class="badge badge-warning">    في الطريق</span>';

                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/orders/ended-orders');
        }
    }

    public function orderDetails($id){
        $details = OrderDetails::where('order_id',$id)->get();
        $order=Order::whereIn('status',['new','delivered','accepted','preparing','on_way'])->findOrFail($id);
//        $offer = OrderOffer::with('order')->where('order_id',$id)->whereIn('status',['accepted','ended'])->firstOrFail();


        return view('Admin/orders/details',compact('details','order'));

    }

    public function orderBill($id){

        $order = Order::where('id',$id)->whereIn('status',['delivered','accepted','preparing','on_way'])->firstOrFail();
        $offer = OrderOffer::where('order_id',$id)->whereIn('status',['accepted','ended'])->firstOrFail();
        $order['day'] = ArabicDate($order->created_at)['ar_day_not_current'] .' '. $order->created_at->format('d').' '.ArabicDate($order->created_at)['month'].' '.$order->created_at->format('Y');
        $offer['day'] = ArabicDate(date('Y-m-d', $offer->delivery_date_time))['ar_day_not_current'] .' '. ArabicDate(date('Y-m-d', $offer->delivery_date_time))['day'].' '.ArabicDate(date('Y-m-d', $offer->delivery_date_time))['month'].' '.date('Y', $offer->delivery_date_time);
        return view('Admin.orders.bill',compact('order','offer'));
    }

    public  function cancelneworder(Request $request){

        $order=Order::find($request->id);
        if($order==null)
            return response()->json(['status'=>false]);
        $order->status='cancel';
        $order->save();
        return response()->json(['status'=>true]);


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
        return redirect()->route('admin.get.invoice.order',$order->id);
//        return redirect()->back()->with('success', 'تم حفظ الطلب');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order = Order::find($request->id);

        $order->delete();
        return response(['message'=>'تم الحذف بنجاح','status'=>200],200);
    }

}
