<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request){

        // validation
        $rules =[
            'username' =>'required',
            'password' => 'required',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['error' => $error]);
        }


        // check and return jwt token
        $userData = $request->only(['username','password']);
        $token = Auth::guard('api')->attempt($userData);
        if(!$token){
            return responseJson(0,'fail',['message' => 'your data is inncorrect']);
        }



        $user= User::where('username',$request->username)->where('password',Hash::check($request->password,'password'))->get();
        return responseJson(1,'success',['user'=> $user , 'token' => $token]);

    }



    // register
    public function register(Request $request){
        // validation
        $rules =[
            'username' =>'required',
            'password' => 'required|confirmed',
            'first_name' => 'required',
            'last_name' =>'required',
            'email' =>'required',
            'mobile' =>'required'
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['error' => $error]);
        }

        // store
        $user = User::create($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        return responseJson(1,'success',['data'=>$user]);

    }





}
