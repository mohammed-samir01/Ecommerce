<?php

namespace App\Http\Controllers;
use App\Http\Resources\General\UsersResource;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AuthController extends Controller
{

    use GeneralTrait;

//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login','register','verifyAccount','forgetpassword','updatepassword']]);
//    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // validation

        $rules =[
            'email'    => 'required |email',
            'password' => 'required',
        ];

        $input = $request->only('email', 'password');

        $validator = Validator::make($input, $rules);

        $token = Auth::guard('api')->attempt($input);

        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json([
                'success'=> false,
                'error'=> $error,
                'token'=> $token,

            ]);
        }

        $user_verify = DB::table('users')->where('email', $request->email)->value('email_verified_at');

        if (!$user_verify) {
            return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 200);

        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        try {
            // attempt to verify the credentials and create a token for the     user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 200);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 200);
        }

        // all good so return the token
        return response()->json(['success' => true, 'token' => $token ]);

    }


    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [

            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ];

        $input = $request->only(
            'first_name',
                'last_name',
                'username',
                'email',
                'mobile',
                'password',
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails()) {

            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $data['first_name']         = $request->first_name;
        $data['last_name']          = $request->last_name;
        $data['username']           = $request->username;
        $data['email']              = $request->email;
        $data['mobile']             = $request->mobile;
        $data['password']           = bcrypt($request->password);

        $user = User::create($data);
        $user->attachRole(Role::whereName('customer')->first()->id);

        //mail verification
        $verification_code =random_int(100000, 999999); //Generate verification code
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'verification_code'=>$verification_code]);
        $subject = "Please verify your email address.";
        $name = $request->username;
        $email = $request->email;
        $token = Auth::guard('api')->attempt($input);

        Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from('Halabsa@ecommerce.com',"Ecommerce");
                $mail->to($email, $name);
                $mail->subject($subject);
            });

        return response()->json([
            'status'  => 'success',
            'message' =>'Your account registered successfully, Please check your email to activate your account.',
            'token'   => $token,
            'user' => $user,

        ]);

    }


    /**
     * API Verify User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function verifyAccount(Request $request ){


        // validation
        $rules =[
            'email'              => 'required |email',
            'verification_code' => 'required',
        ];
        $input = $request->only('email', 'verification_code');
        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json([
                'success'=> false,
                'error'=> $error,
            ]);
        }

        $user_id= DB::table('users')->where('email', $request->email)->value('id');
        $check_verify = DB::table('user_verifications')->where('user_id', $user_id)->value('verification_code');
        if($check_verify==$request->verification_code && $check_verify!=null && $user_id!=null) {
            DB::table('users')
                ->where('id', $user_id)  // find your user by their email
                ->update(array('email_verified_at' => now()));  // update the record in the DB.

            return response()->json([
                'message'=>'account has been verified successfully',
                'check_verify'=>$check_verify,
                'user_id'=>$user_id
            ]);
        }

        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
    }



    public function forgetpassword(Request $request ){

        $user_id= DB::table('users')->where('email', $request->email)->value('id');
        if($user_id!=null){
            $subject = "forget your password";
            $email=$request->email;
            Mail::send('password', ['user_id' =>$user_id ],
                function($mail) use ( $subject,$email,$user_id){
                    $mail->from('Halabsa@ecommerce.com');
                    $mail->to($email);
                    $mail->subject($subject);
                });
            return response()->json([

                'user_id'=>$user_id,
                'message' => 'Check Your Email',

            ]);

        }
        return response()->json([

            'message'=>'your email was wrong ,please try again'
        ]);

    }

    public function updatePassword(Request $request, $id){

        $rules =  [
            'password' => ['string', 'min:8']
        ];

        $input = $request->only(
            'password',
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails()) {

            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $user= User::find($id);


        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {

            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json('success');
        }else{

            return response()->json('Error');
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


    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */

    public function logout(Request $request) {

        Auth::logout();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);

    }


    /**
     * API Recover Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }

        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });

        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }

        return response()->json([
            'success' => true, 'data'=> ['msg'=> 'A reset email has been sent! Please check your email.']
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */



    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
