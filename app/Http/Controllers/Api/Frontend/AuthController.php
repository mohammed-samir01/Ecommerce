<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\resetPassword;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{


    // login
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


    // forget password
    public function forgetPassword(Request $request){


        // validation
        $rules=[
            'email' => 'required'
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'faild',['data'=>$error]);
        }



        $user_email = $request->email;
        $user = User::where('email',$user_email)->first();
        if($user){
            $code = rand(11111,99999);
            $user->pin_code =$code;
            $user->save();
            Mail::to($user->email)->send(new resetPassword($code));
            return responseJson(1,'success',['data'=>'code is sent to user email','user'=>$user]);
        }else{
            return responseJson(0,'fail',['data'=>'email is not correct']);
        }

    }


    // reset password
    public function resetPassword(Request $request){
        // validation
        $rules=[
            'pin_code' =>'required',
            'email' => 'required',
            'new_password' =>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'faild',['data'=>$error]);
        }


        $user = User::where('email',$request->email)->where('pin_code',$request->pin_code)->first();
        if($user){
            $user->password = bcrypt($request->new_password);
            $user->pin_code = null;
            $user->save();
            return responseJson(1,'success ,new password added',['data'=>$user]);
        }else{
            return responseJson(0,'fail',['data'=>'data is incorrect']);
        }
    }



    // register token
    public function registerToken(Request $request){
        // validation
        $rules =[
            'user_id' =>'required',
            'token'=>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }


        Token::where('token',$request->token)->delete();
        $user = User::find($request->user_id);
        $token = $user->tokens()->create($request->all());
        return responseJson(1,'success',['user'=>$user]);

    }



    // delete token
    public function removeToken(Request $request){
        // validation
        $rules =[
            'user_id' =>'required',
            'token'=>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }


        Token::where('token',$request->token)->delete();
        return responseJson(1, 'success', ['data'=>'token is deleted']);
    }



}



