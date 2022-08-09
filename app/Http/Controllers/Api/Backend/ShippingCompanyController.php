<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{public function index()
    {
        $shipping_companies = ShippingCompany::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['shipping_companies' => $shipping_companies]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:shipping_companies',
            'code'=>'required',
            'description'=>'required',
            'cost'=>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $ShippingCompany = ShippingCompany::create($request->all());


        // response
        return responseJson(1,'success',['ShippingCompany'=>$ShippingCompany]);


    }



    public function show($id)
    {

        $ShippingCompany = ShippingCompany::find($id);
        if(!$ShippingCompany){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$ShippingCompany]);
        }
    }


    public function update(Request $request, $id)
    {
        $ShippingCompany = ShippingCompany::find($id);

        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:shipping_companies,name,'.$id.'id',
            'code'=>'required|unique:shipping_companies,name,'.$id.'id',
            'description'=>'required|unique:shipping_companies,name,'.$id.'id',
            'cost'=>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $ShippingCompany->update($request->all());


        // response
        return responseJson(1,'success',['ShippingCompany'=>$ShippingCompany]);


        }





    public function destroy($id)
    {
        $ShippingCompany =ShippingCompany::find($id);
        if(!$ShippingCompany){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $ShippingCompany->delete();
        return responseJson(1,'success',['data'=>$ShippingCompany->name." is deleted"]);
    }
}
