<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['states' => $states]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:states',
            'country_id' => 'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $State = State::create($request->all());


        // response
        return responseJson(1,'success',['State'=>$State]);


    }



    public function show($id)
    {

        $State = State::find($id);
        if(!$State){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$State]);
        }
    }


    public function update(Request $request, $id)
    {
        $State = State::find($id);

        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:states,name,'.$id.',id',
            'country_id' => 'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $State->update($request->all());


        // response
        return responseJson(1,'success',['State'=>$State]);


        }





    public function destroy($id)
    {
        $State =State::find($id);
        if(!$State){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $State->delete();
        return responseJson(1,'success',['data'=>$State->name." is deleted"]);
    }
}
