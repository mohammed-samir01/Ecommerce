<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\resetPassword;



class AuthController extends Controller
{

    use GeneralTrait;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function login(Request $request)
    {

        // validation
        $rules =[
            'email'    => 'required',
            'username' =>'required',
            'password' => 'required',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors();
            return  response()->json($error) ;
        }

        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

//        $user = Auth::user();
      $user = User::where('email',$request->email)->where('password',Hash::check($request->password,'password'))->get();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

    }


    // register
    public function register(Request $request)
    {
        // validation
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required',
            'mobile' => 'required'
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $error = $validator->errors();

           return $this->returnData('Error',$error,'Fail');
        }

        // store
        $user = User::create($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

       return $this->returnData('success',$user,'success');

    }


    // forget password
    public function forgetPassword(Request $request)
    {

        // validation
        $rules = [
            'email' => 'required'
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
          return  $this->returnData('Failed',$error);

        }

        $user_email = $request->email;
        $user = User::where('email', $user_email)->first();
        if ($user) {
            $code = rand(11111, 99999);
            $user->pin_code = $code;
            $user->save();
            Mail::to($user->email)->send(new resetPassword($code));

         return   $this->returnData('Success',$user,'code is sent to user email');

        } else {

          return  $this->returnError(0,'email is not correct');
        }

    }


    // reset password

    public function resetPassword(Request $request)
    {
        // validation
        $rules = [
            'pin_code' => 'required',
            'email' => 'required',
            'new_password' => 'required'
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            $error = $validator->errors()->first();

            return $this->returnData('Error',$error,);

        }


        $user = User::where('email', $request->email)->where('pin_code', $request->pin_code)->first();
        if ($user) {
            $user->password = bcrypt($request->new_password);
            $user->pin_code = null;
            $user->save();

             return $this->returnData('Data',$user,'success ,new password added');

        } else {

            return  $this->returnError('0','data is incorrect');
        }
    }



    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function me()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }


}
