<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // index
    public function index()
    {
        // if (!auth()->user()->ability('admin', 'manage_customers, show_customers')) {
        //     return redirect('admin/index');
        // }

        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


            // $current = Carbon::now()->format('d-m-Y');
            $current = date('Y-m-d H:i:s');

        return responseJson(1,'success',['data'=>$customers,'time'=>$current]);
    }




    public function store(Request $request)
    {

        // validation
        $rules =[
            'first_name' =>'required',
            'last_name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'password'=>'required',
            'status'=>'required',
            'file'=>'required'
        ];
        $validator = validator()->make($request->all(),$rules);

        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }


        // store
        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        $input['password'] = bcrypt($request->password);
        $input['status'] = $request->status;



        $customer = User::create($input);
        $customer->attachRole(Role::whereName('customer')->first()->id);

        // save image into customer folder , and save its path in database
        // $path = $request->file('file')->store('customers');

        $path = $request->file('file')->store('customers');
        $customer->user_image =$path;
        $customer->save();

        return responseJson(1,'success',['data'=>$customer,'path'=>$path]);
    }


    // show
    public function show($id){
        $customer = User::find($id);
        return responseJson(1,'success',['user'=>$customer]);
    }




    // update
    public function update(Request $request, $id){

        // validation
        $rules=[
        //     'first_name' =>'required',
        //     'last_name'=>'required',
        //     'username'=>'required',
        //     'email'=>'required',
        //     'mobile'=>'required',
        //     'password'=>'required',
        //     'status'=>'required',
            // 'file'=>'required'
        ];


        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'validationError',['error'=>$error]);
        }

        // store
        $customer = User::find($id);
        $customer->update($request->all());


        if($request->hasFile('file')){

            $image_path = $customer->user_image;    //'customer/image.jpg'

            if($image_path != null){
                Storage::delete($image_path);    //delete image from folder
            }

            $new_path = $request->file('file')->store('customers');  //'customer/newImage.jpg'
            $customer->user_image = $new_path;
            $customer->save();
        }
        return responseJson(1,'success',['user'=>$customer]);
    }


    // delete
    public function destroy($id){
        $customer = User::find($id);
        $customer_image = $customer->user_image;

        if($customer_image != null){
            Storage::delete($customer_image);
        }

        $customer->delete();
        return responseJson(1,'success','deleted');
    }




    // delete image
    public function deleteImage($id){
        $user = User::find($id);
        $user_image = $user->user_image;
        if($user_image != null ){
            Storage::delete($user_image);   //delete from the folder
            $user->user_image = null;   //delete from DB
            $user->save();
            return responseJson(1,'deleted',['user'=>$user]);
        }else{
            return responseJson(0,'there is no image to be deleted',['user'=>$user]);
        }

    }

}
