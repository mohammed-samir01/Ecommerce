<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category', 'tags', 'firstMedia')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return responseJson(1,'success',['data'=>$products]);
    }






    public function store(Request $request)
    {

        // validation
        $rules = [
            'name' =>'required|unique:products',
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'faild',['error'=>$error]);
        }


        // store
        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['price'] = $request->price;
        $input['quantity'] = $request->quantity;
        $input['product_category_id'] = $request->product_category_id;
        $input['featured'] = $request->featured;
        $input['status'] = $request->status;

        $product = Product::create($input);
        $product->tags()->attach($request->tags);

        return responseJson(1,'success',['data' => $product ]);

    }







    public function show($id)
    {
        $product = Product::find($id);
        if(!$product){
            return responseJson(0,'faild',['data'=>'id is incorrect']);
        }else{
            $tags = $product->tags;
            return responseJson(1,'success',['data'=>$product, 'tags' => $tags]);
        }
    }




    public function update(Request $request, $id)
    {
        // validation
        $rules = [
            'name' =>'required|unique:products,name,'.$id.',id',
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'faild',['error'=>$error]);
        }


        // store
        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['price'] = $request->price;
        $input['quantity'] = $request->quantity;
        $input['product_category_id'] = $request->product_category_id;
        $input['featured'] = $request->featured;
        $input['status'] = $request->status;

        $product = Product::find($id);
        $product->update($input);
        $product->tags()->attach($request->tags);

        return responseJson(1,'success',['data' => $product]);
    }






    public function destroy($id)
    {
        $product =Product::find($id);
        if(!$product){
            return responseJson(0,'faild',['data' => 'id is incorrect']);
        }else{
            $product->delete();
            return responseJson(1,'success',[$product->name => 'deleted successfully']);

        }


    }
}
