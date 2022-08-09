<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    public function index()
    {
        $UserAddresses = UserAddress::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['UserAddresses' => $UserAddresses]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'user_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'address_title' => 'required',
            'mobile' => 'required',
            'zip_code' =>'required',
            'po_box' => 'required',
            'first_name' =>'required',
            'last_name' => 'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $UserAddress = UserAddress::create($request->all());


        // response
        return responseJson(1,'success',['UserAddress'=>$UserAddress]);


    }



    public function show($id)
    {

        $UserAddress = UserAddress::find($id);
        if(!$UserAddress){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$UserAddress]);
        }
    }


    public function update(Request $request, $id)
    {
        $UserAddress = UserAddress::find($id);

        //validation
        $rules = [
            'mobile' => 'unique:user_addresses,mobile,'.$id.',id',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $UserAddress->update($request->all());


        // response
        return responseJson(1,'success',['UserAddress'=>$UserAddress]);


        }





    public function destroy($id)
    {
        $UserAddress =UserAddress::find($id);
        if(!$UserAddress){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $UserAddress->delete();
        return responseJson(1,'success',['data'=>$UserAddress->address_title." is deleted"]);
    }
}
