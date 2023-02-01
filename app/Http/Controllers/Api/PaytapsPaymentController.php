<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DOMDocument;
use Illuminate\Http\Request;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class PaytapsPaymentController extends Controller
{
    public function store(Request $request)
    {
        $user = auth('user-api')->user();
//        dd($user);
        $transaction_type = 'sale';
        $cart_id = uniq_id_number();
        $cart_amount = $request->amount;
        $cart_description = 'description';
        $name = 'customer name';
        $email = (isset($user->email)) ? $user->email : 'customer@example.com';
        $phone = $user->phone;
        $street1 = 'street';
        $city = 'EG';
        $state = 'MNF';
        $country = '10';
        $zip = '10111';
        $ip = (isset($_SERVER['HTTP_CLIENT_IP'])) ?  $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        $same_as_billing = uniq_id_number();
        $callback = route('callback_tap');
        $return = route('return_paytap');

        $language = 'en';
//        $pay = paypage::sendPaymentCode('all')->sendTransaction($transaction_type)
//            ->sendCart($cart_id, $cart_amount, $cart_description)->sendCustomerDetails($name, $email, $phone, $street1, $city, $state, $country, $zip, $ip)
//            ->sendShippingDetails($same_as_billing, $name = null, $email = null, $phone = null, $street1= null, $city = null, $state = null, $country = null, $zip = null, $ip = null)->sendHideShipping($on = false)
//            ->sendURLs($return, $callback)->sendLanguage($language)->sendFramed($on = false)->create_pay_page(); // to initiate payment page

        $pay =  paypage::sendPaymentCode('all')
            ->sendTransaction($transaction_type)
            ->sendCart($cart_id,$cart_amount,$cart_description)
            ->sendCustomerDetails($name, $email, $phone, 'street', 'Nasr City', 'Cairo', 'EG', '1234',$ip)
            ->sendShippingDetails($name, $email, $phone, 'street', 'Nasr City', 'Cairo', 'EG', '1234',$ip)
            ->sendURLs($return, $callback)
            ->sendLanguage('en')
            ->create_pay_page();

            $data['payment_url'] = $pay->getTargetUrl();

         return  helperJson($data);
    }

    public function callback_tap()
    {
    }
    public function return_paytap()
    {
    }
}
