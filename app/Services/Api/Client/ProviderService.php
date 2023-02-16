<?php

namespace App\Services\Api\Client;

use App\Http\Resources\Client\ProvidersResource;
use App\Models\User;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use function auth;
use function helperJson;

class ProviderService
{
    use DefaultImage,GeneralTrait;
    public function index(){
//        $user = auth()->user();
        $providers = User::where('role_id', 1)->get();

        return helperJson(ProvidersResource::collection($providers), '');
    }
}
