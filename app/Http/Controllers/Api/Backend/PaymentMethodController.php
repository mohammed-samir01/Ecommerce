<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['payment_methods' => $payment_methods]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:payment_methods',
            'code'=>'required',
            'driver_name' =>'required',
            'username'=>'required',
            'password'=>'required',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $PaymentMethod = PaymentMethod::create($request->all());
        $PaymentMethod->password = bcrypt($request->password);
        $PaymentMethod->save();


        // response
        return responseJson(1,'success',['PaymentMethod'=>$PaymentMethod]);


    }



    public function show($id)
    {

        $PaymentMethod = PaymentMethod::find($id);
        if(!$PaymentMethod){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$PaymentMethod]);
        }
    }


    public function update(Request $request, $id)
    {
        $PaymentMethod = PaymentMethod::find($id);

        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:payment_methods,name,'.$id.',id',
            'code'=>'required',
            'driver_name' =>'required',
            'username'=>'required',
            'password'=>'required',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $PaymentMethod->update($request->all());

        $PaymentMethod->password = bcrypt($request->password);
        $PaymentMethod->save();


        // response
        return responseJson(1,'success',['PaymentMethod'=>$PaymentMethod]);


        }





    public function destroy($id)
    {
        $PaymentMethod =PaymentMethod::find($id);
        if(!$PaymentMethod){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $PaymentMethod->delete();
        return responseJson(1,'success',['data'=>$PaymentMethod->name." is deleted"]);
    }

}
