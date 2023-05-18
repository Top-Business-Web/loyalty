<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Traits\GeneralTrait;

class ClientOrderService
{
    use GeneralTrait;
    public function list(){
        $user = auth('user-api')->user();
        $data['new'] = OrderResource::collection(Order::where('user_id', $user->id)->where('status' ,'new')->get());
        $data['accepted'] = OrderResource::collection(Order::where('user_id', $user->id)->where('status' ,'accepted')->get());
//        dd(OrderResource::collection($orders));
        return helperJson($data, '');
    }

    public function store($request){
        $rules = [
            'phone' => 'required|exists:users,phone',
            'total_price' => 'required|min:1',
            'order_details' => 'required|array|min:1',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'phone.exists' => 411,
        ]);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    411 => 'Failed,phone not exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return response()->json(['data' => null, 'message' => $validator->errors(), 'code' => 422], 200);
        }
        $request->validate($rules);
        $inputs = request()->all();
        $provider = User::where('phone',$inputs['phone'])->first();
        $data['provider_id'] = $provider->id;
        $data['user_id'] = auth('user-api')->user()->id;
        $data['total_price'] = $inputs['total_price'];
        if(isset($inputs['note'])) {
            $data['note'] = $inputs['note'];
        }
        $order = Order::create($data);

        $order->details()->createMany($inputs['order_details']);
        return helperJson(new OrderResource($order), 'تمت الاضافة بنجاح');
    }


    public function complete_and_charge($request){
        $rules = [
            'provider_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'provider_id.exists' => 411,
            'order_id.exists' => 417,
        ]);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    411 => 'Failed,user not exists',
                    417 => 'Failed,order not exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return response()->json(['data' => null, 'message' => $validator->errors(), 'code' => 422], 200);
        }
        $request->validate($rules);
        $inputs = request()->all();
        $provider = User::where('id',$inputs['provider_id'])->first();
        $order = Order::where('id',$inputs['order_id'])->first();
        $client = auth('user-api')->user();
        if($client->balance <  $order->total_price){
            return helperJson(null, "لا يوجد رصيد كافي لدينا يرجي الشحن وإعادة المحاولة", 413);
        }
        if($order->status == 'delivered'){
            return helperJson(null, "تم دفع قيمة الطلب من قبل بنجاح", 415);
        }
        // take from client
        $client->balance = $client->balance - $order->total_price;
        $client->save();
        // pay to provider
        $provider->balance = $provider->balance + $order->total_price;
        $provider->save();
        $order->status = 'delivered';
        $order->save();
        return helperJson($order, 'تم عملية الدفع بنجاح');
    }

    public function cancel_and_charge($request){
        $rules = [
            'order_id' => 'required|exists:orders,id',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'order_id.exists' => 417,
        ]);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    417 => 'Failed,order not exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return response()->json(['data' => null, 'message' => $validator->errors(), 'code' => 422], 200);
        }
        $request->validate($rules);
        $inputs = request()->all();
        $order = Order::where('id',$inputs['order_id'])->first();

        $order->status = 'rejected';
        $order->save();
        return helperJson($order, 'تم الغاء الطلب');
    }

}
