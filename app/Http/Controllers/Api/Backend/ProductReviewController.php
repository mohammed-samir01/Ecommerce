<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {
        $product_reviews = ProductReview::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

            return responseJson(1,'success',['product_reviews' => $product_reviews]);
    }



    public function store(Request $request)
    {
        //validation
        $rules = [
            'user_id' => 'required',
            'product_id' =>'required',
            'name' => 'required',
            'email' =>'required',
            'title'=>'required',
            'rating' =>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // store
        $ProductReview = ProductReview::create($request->all());


        // response
        return responseJson(1,'success',['ProductReview'=>$ProductReview]);


    }



    public function show($id)
    {

        $ProductReview = ProductReview::find($id);
        if(!$ProductReview){
            return responseJson(0,'faill',['data'=>'id is not correct']);
        }else{
            return responseJson(1,'success',['data'=>$ProductReview]);
        }
    }


    public function update(Request $request, $id)
    {
        $ProductReview = ProductReview::find($id);

        //validation
        $rules = [
            'user_id' => 'required',
            'product_id' =>'required',
            'name' => 'required',
            'email' =>'required',
            'title'=>'required',
            'rating' =>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',$error);
        }


        // update
        $ProductReview->update($request->all());


        // response
        return responseJson(1,'success',['ProductReview'=>$ProductReview]);


        }





    public function destroy($id)
    {
        $ProductReview =ProductReview::find($id);
        if(!$ProductReview){
            return responseJson(0,'fail',['data'=>'id is not correct']);
        }

        $ProductReview->delete();
        return responseJson(1,'success',['data'=>$ProductReview->name." is deleted"]);
    }
}
