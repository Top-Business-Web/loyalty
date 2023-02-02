<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
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
        $callback = url('/api/callback_paytabs');
        $return = url('/api/return_paytabs');

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

    public function callback_paytabs(Request $request)
    {
        return $request->status;
    }


    public function return_paytabs(Request $request)
    {
        $tran_ref =  $request->tranRef;
        $str_response =  json_encode(Paypage::queryTransaction($tran_ref));
        $transaction_response  = json_decode($str_response, true);
        $user = User::where('phone',$transaction_response['customer_details']['phone'])->first();
dd($transaction_response);
        $payment = Payment::create([
                    'tran_ref' => $transaction_response['tran_ref'],
                    'reference_no' => $transaction_response['reference_no'],
                    'transaction_id' => $transaction_response['transaction_id'],
                    'user_id' => $user->id,
                    'status' => $transaction_response['success'],
                    'amount' => $transaction_response['success'],
                    'currency' => $transaction_response['currency'],
                     ]);
        $new_balance = $user->balance + $transaction_response['amount'];

        $user->update(['balance' =>$new_balance]);

        return redirect()->to('/api/callback_paytabs?status='.$payment->status);
    }
}
