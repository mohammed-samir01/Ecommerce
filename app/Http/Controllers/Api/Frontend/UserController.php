<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Http\Resources\General\UsersResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function userProfile()
    {

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => new UsersResource($user)
        ]);
    }

    public function update_profile(ProfileRequest $request)
    {

        $user = auth()->user();
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;

        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {
            $data['password'] = bcrypt($request->password);
        }

        if ($user_image = $request->file('user_image')) {
            if ($user->user_image != '') {
                if (File::exists('assets/users/' . $user->user_image)){
                    unlink('assets/users/' . $user->user_image);
                }
            }

            $file_name = $user->username . '.' . $user_image->extension();
            $path = public_path('assets/users/'. $file_name);
            Image::make($user_image->getRealPath())->resize(300, null, function ($constraints) {
                $constraints->aspectRatio();
            })->save($path, 100);
            $data['user_image'] = $file_name;
        }

        $user->update($data);

        return response()->json(['errors'=>false,'message'=>'Profile updated'],200);
    }


    public function remove_profile_image()
    {
        $user = auth()->user();
        if ($user->user_image != '') {
            if (File::exists('assets/users/' . $user->user_image)){
                unlink('assets/users/' . $user->user_image);
            }
        }
        $user->user_image = null;
        $user->save();
        return response()->json(['errors'=>false,'message'=>'Profile image deleted'],200);

    }

}
