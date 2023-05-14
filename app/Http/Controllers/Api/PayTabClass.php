<?php

namespace App\Http\Controllers\Api;

use Paytabscom\Laravel_paytabs\Facades\paypage;

class PayTabClass extends Paypage
{
    public $target_start_url ;
    public function __construct(){
        parent::__construct();
        parent::create_pay_page()->target_url_fun = $this->target_url_fun();
    }
    public function target_url_fun() {

    }
}
