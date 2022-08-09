<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['cities' => $cities]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:cities',
            'state_id' => 'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $City = City::create($request->all());


        // response
        return responseJson(1,'success',['City'=>$City]);


    }



    public function show($id)
    {

        $City = City::find($id);
        if(!$City){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$City]);
        }
    }


    public function update(Request $request, $id)
    {
        $City = City::find($id);

        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:cities,name,'.$id.',id',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $City->update($request->all());


        // response
        return responseJson(1,'success',['City'=>$City]);


        }





    public function destroy($id)
    {
        $City =City::find($id);
        if(!$City){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $City->delete();
        return responseJson(1,'success',['data'=>$City->name." is deleted"]);
    }



}
