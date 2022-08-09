<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['orders' => $orders]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'ref_id' => 'required',
            'user_id' => 'required',
            'user_address_id' => 'required',
            'payment_method_id' =>'required',
            'shipping_company_id' =>'required',
            'discount_code' => 'required',
            'discount' => 'required',
            'shipping' => 'required',
            'tax' => 'required',
            'currency' => 'required',
            'subtotal' => 'required',
            'total' => 'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $Order = Order::create($request->all());


        // response
        return responseJson(1,'success',['Order'=>$Order]);


    }



    public function show($id)
    {

        $Order = Order::find($id);
        if(!$Order){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$Order]);
        }
    }



    public function update(Request $request, $id)
    {
        $Order = Order::find($id);

        //validation
        $rules = [
            'user_id' => 'required',
            'user_address_id' => 'required',
            'payment_method_id' =>'required',
            'shipping_company_id' =>'required',
            // 'ref_id' => 'required',
            // 'discount_code' => 'required',
            // 'discount' => 'required',
            // 'shipping' => 'required',
            // 'tax' => 'required',
            // 'currency' => 'required',
            // 'subtotal' => 'required',
            // 'total' => 'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $Order->update($request->all());


        // response
        return responseJson(1,'success',['Order'=>$Order]);


        }





    public function destroy($id)
    {
        $Order =Order::find($id);
        if(!$Order){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $Order->delete();
        return responseJson(1,'success',['data'=>$Order->name." is deleted"]);
    }

}
