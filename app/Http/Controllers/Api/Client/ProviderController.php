<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\Api\Client\ProviderService;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    private ProviderService $providerService;

    /**
     * @param providerService $providerService
     */
    public function __construct(ProviderService $providerService)
    {
//        $this->middleware('auth_jwt');
        $this->providerService = $providerService;
    }

    public function index(Request $request){
        return $this->providerService->index($request);
    }
}
