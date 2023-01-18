<?php

namespace App\Services;

use App\Models\FirebaseToken;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;

class NotificationService
{
    public function getAll()
    {
        $user_id = auth()->user()->id;
        $notifications = Notification::where('user_id',$user_id)->get();
        return response()->json(['data' => $notifications], 200);
    }

    public function insert_token($request)
    {
        $rules = [
            'phone_token' => 'required',
            'software_type' => 'required|in:android,ios,web'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    409 => 'Failed,phone number already exists',
                    410 => 'Failed,email already exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return helperJson(null, $validator->errors(), 422);
        }
        $data = $request->validate($rules);

        $data['user_id'] = auth()->user()->id;

        $token = FirebaseToken::updateOrCreate($data);

        return helperJson($token, 'register successfully');
    }//end fun

}
