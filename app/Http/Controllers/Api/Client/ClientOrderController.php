<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\ClientOrderService;
use Illuminate\Http\Request;
use App\Services\Api\OrderService;

class ClientOrderController extends Controller
{
    private ClientOrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(ClientOrderService $orderService)
    {
        $this->middleware('auth_jwt');
        $this->orderService = $orderService;
    }

    public function index(){
        return $this->orderService->list();
    }

    public function store(request $request){
        return $this->orderService->store($request);
    }

    public function completeOrdering(request $request){
        return $this->orderService->complete_and_charge($request);
    }

    public function cancelOrder(request $request){
        return $this->orderService->cancel_and_charge($request);
    }
}
