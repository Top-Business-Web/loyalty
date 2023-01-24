<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class InvoiceController extends Controller
{

    public function getInvoice($id){
        $order=Order::whereIn('status',['new','delivered','accepted','preparing','on_way'])->findOrFail($id);
        return view('Admin.invoice.index',compact('order'));
    }
}
