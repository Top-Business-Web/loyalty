<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactUs;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:191',
            'phone' => 'required|min:2|max:191',
            'subject' => 'nullable',
            'message' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return helperJson(null, $validator->errors(), 422);
        }
        $user = auth()->user();
        $inputs = request()->all();

        $contact_us = ContactUs::create($inputs);
        return helperJson($contact_us, 'تمت الاضافة بنجاح');
    }
}
