<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function login(Request $request){
        $userData = $request->only(['username','password']);
        $token = Auth::guard('api')->attempt($userData);
        if(!$token){
            return ['token' => $token];

        }else{
            return $token ;
        }

    }
}
