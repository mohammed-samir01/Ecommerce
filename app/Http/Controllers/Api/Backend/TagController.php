<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['tags' => $tags]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:tags',
            'slug' => 'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $Tag = Tag::create($request->all());


        // response
        return responseJson(1,'success',['Tag'=>$Tag]);


    }



    public function show($id)
    {

        $Tag = Tag::find($id);
        if(!$Tag){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$Tag]);
        }
    }


    public function update(Request $request, $id)
    {
        $Tag = Tag::find($id);

        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:tags,name,'.$id.',id',
            'slug'=>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $Tag->update($request->all());


        // response
        return responseJson(1,'success',['Tag'=>$Tag]);


        }





    public function destroy($id)
    {
        $Tag =Tag::find($id);
        if(!$Tag){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $Tag->delete();
        return responseJson(1,'success',['data'=>$Tag->name." is deleted"]);
    }
}
