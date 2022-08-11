<?php

namespace App\Http\Controllers;
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

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

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

        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_verified' => 1
        ];

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);

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
            $error = $validator->messages()->toJson();
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
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        $name = $request->username;
        $email = $request->email;
        Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from('Halabsa@ecommerce.com',"From User/Company Name Goes Here");
                $mail->to($email, $name);
                $mail->subject($subject);
            });

        return response()->json([
            'status' => 'success',
            'message' =>'Your account registered successfully, Please check your email to activate your account.',
            'user' => $user,

        ]);

    }


    /**
     * API Verify User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();

        if(!is_null($check)){
            $user = User::find($check->user_id);

            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }

            $user->update(['is_verified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();

            return response()->json([
                'success'=> true,
                'message'=> 'You have successfully verified your email address.'
            ]);
        }

        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);

    }


//    // reset password

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
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
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
