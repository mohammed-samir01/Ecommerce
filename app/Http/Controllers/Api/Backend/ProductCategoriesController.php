<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['productCategories' => $productCategories]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:product_categories',
            'cover' => 'required',
            'parent_id' => 'required',
            'slug' =>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $ProductCategory = ProductCategory::create($request->all());


        // response
        return responseJson(1,'success',['ProductCategory'=>$ProductCategory]);


    }



    public function show($id)
    {

        $ProductCategory = ProductCategory::find($id);
        if(!$ProductCategory){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$ProductCategory]);
        }
    }


    public function update(Request $request, $id)
    {
        $ProductCategory = ProductCategory::find($id);

        //validation
        $rules = [
            'name' => 'required|min:3|max:50|unique:product_categories',
            'cover' => 'required',
            'parent_id' => 'required',
            'slug' =>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $ProductCategory->update($request->all());


        // response
        return responseJson(1,'success',['ProductCategory'=>$ProductCategory]);


        }





    public function destroy($id)
    {
        $ProductCategory =ProductCategory::find($id);
        if(!$ProductCategory){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $ProductCategory->delete();
        return responseJson(1,'success',['data'=>$ProductCategory->name." is deleted"]);
    }
}
