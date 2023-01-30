<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Traits\GeneralTrait;

class OrderService
{
    use GeneralTrait;
    public function list(){
        $provider = auth('user-api')->user();
        $orders = Order::where('provider_id', $provider->id)->get();
        return helperJson(OrderResource::collection($orders), '');
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
        $client = User::where('phone',$inputs['phone'])->first();
        $data['user_id'] = $client->id;
//        dd(auth('user-api')->user()->id);
        $data['provider_id'] = auth('user-api')->user()->id;
        $data['total_price'] = $inputs['total_price'];
        if(isset($inputs['note'])) {
            $data['note'] = $inputs['note'];
        }
        $order = Order::create($data);

        $order->details()->createMany($inputs['order_details']);
        return helperJson(new OrderResource($order), 'تمت الاضافة بنجاح');
    }

}
