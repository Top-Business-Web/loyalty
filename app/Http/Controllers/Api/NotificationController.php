<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\FirebaseToken;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function getAll(): JsonResponse
    {
        $user_id = auth()->user()->id;
        $notifications = Notification::where('user_id',$user_id)->get();
        return response()->json(['data' => $notifications], 200);
    }

    public function insert_token(Request $request): JsonResponse
    {
        $rules = [
            'client_id' => 'nullable|exists:users,id',
            'provider_id' => 'nullable|exists:users,id',
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
                return helperJson(null, $errors_arr[$errors] ?? 500, $code);
            }
            return helperJson(null, $validator->errors(), 422);
        }


        if($request->client_id == null && $request->provider_id == null){
            return helperJson(null,"Please choose client_id or provider_id to add firebaseToken");
        }
        $data = $request->validate($rules);

        $token = FirebaseToken::create($data);

        return helperJson(new NotificationResource($token), 'Firebase Token inserted successfully');
    }
}
