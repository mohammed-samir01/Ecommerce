<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCoupon;
use Illuminate\Http\Request;

class ProductCouponController extends Controller
{
    public function index()
    {
        $product_coupons = ProductCoupon::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['product_coupons' => $product_coupons]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'code' => 'required',
            'type' =>'required',
            'value'=>'required',
            'description' => 'required',
            'use_times'=>'required',
            'used_times'=>'required',
            'start_date' =>'required',
            'expire_date' =>'required',
            'greater_than' =>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $ProductCoupon = ProductCoupon::create($request->all());


        // response
        return responseJson(1,'success',['ProductCoupon'=>$ProductCoupon]);


    }



    public function show($id)
    {

        $ProductCoupon = ProductCoupon::find($id);
        if(!$ProductCoupon){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$ProductCoupon]);
        }
    }


    public function update(Request $request, $id)
    {
        $ProductCoupon = ProductCoupon::find($id);

        //validation
        $rules = [
            'code' => 'required',
            'type' =>'required',
            'value'=>'required',
            'description' => 'required',
            'use_times'=>'required',
            'used_times'=>'required',
            'start_date' =>'required',
            'expire_date' =>'required',
            'greater_than' =>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $ProductCoupon->update($request->all());


        // response
        return responseJson(1,'success',['ProductCoupon'=>$ProductCoupon]);


        }





    public function destroy($id)
    {
        $ProductCoupon =ProductCoupon::find($id);
        if(!$ProductCoupon){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $ProductCoupon->delete();
        return responseJson(1,'success',['data'=>$ProductCoupon->code." is deleted"]);
    }
}
