<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        $users = User::select('id,name,phone')->where('phone','like', "%".$request->search_key."%")->get();
        return helperJson($users, '',200);
    }
}
