<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Traits\GeneralTrait;

class RegisterController extends Controller
{

    use GeneralTrait;


    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        $customer = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' => $data['mobile'],
            'user_image' => 'avatar.svg'

        ]);
        if (isset($data['user_image'])) {
            if ($image = $data['user_image']) {
                $filename = Str::slug($data['username']) . '.' . $image->getClientOriginalExtension();
                $path = public_path('/assets/users/' . $filename);
                Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $customer->update(['user_image' => $filename]);
            }
        }

        $customer->attachRole(Role::whereName('customer')->first()->id);
        return $customer;

    }
        protected function registered(Request $request, $customer)
        {

            if($request->wantsJson()){
                return response()->json([
                   'errors'  => false,
                   'message' =>  'Your account registered successfully, Please check your email to activate your account.',
                ]);
            }

            redirect()->route('frontend.index')->with([
                'message' => 'Your account registered successfully, Please check your email to activate your account.',
                'alert-type' => 'success'
            ]);
        }

}
