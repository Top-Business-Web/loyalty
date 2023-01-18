<?php

namespace App\Services;

use App\Models\ContactUs;
use Symfony\Component\HttpFoundation\Response;

class ContactUsService
{
    public function store($request){
        try {
            $inputs = $request->all();
            $contact = ContactUs::create($inputs);
            return helperJson($contact, 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
