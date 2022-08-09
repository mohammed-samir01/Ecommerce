<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\User;
use App\Models\product;
use App\Models\media;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function display($user_id){
          $user_cart= cart::all()->where('user_id',$user_id);
          return $user_cart;
    } */
    public function display(Request $request){
        /* $user_cart= cart::join('media', 'media.madiable_id', '=', 'product_id.id')
        ->where('product_id', $request->user_id)
        ->get(); */
/*         $user_cart= Product::join('media','media.mediable_id','=','Products.id')->where('Products.id',8)->get();
 */      $user_cart= cart::all()->where('user_id',$request->user_id);

        if($user_cart){
            return $user_cart;
        }else{
           return response()->json([ 'message'=>'your cart is empty']);
        }


  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addtocart(Request $request)
    {
       $price=product::all()->where('id',$request->product_id);
        foreach($price as $p){
            $price=$p['price'];
        }
        if(blank(cart::all()->where('user_id',$request->user_id)->where('product_id',$request->product_id))){
            cart::create([
                'user_id'=>$request->user_id,
                'product_id'=>$request->product_id,
                'price'=>$price
            ]);
            return cart::all()->where('user_id',$request->user_id);
        }
        else{
            return response()->json([ 'message'=>'this product already in cart']);

        }
    }

    public function update_quantity(Request $request){
        $price=product::all()->where('id',$request->product_id);
        foreach($price as $p){
            $price=$p['price'];
        }

        cart::where('user_id',$request->user_id)
        ->where('product_id',$request->product_id)
        ->update(['quantity'=>$request->quantity,'price'=>$price*$request->quantity]);
         return cart::all()->where('user_id',$request->user_id)->where('product_id',$request->product_id);
    }
    public function deletecartproduct(Request $request){
        cart::where('user_id',$request->user_id)
        ->where('product_id',$request->product_id)
        ->delete();
        return cart::all()->where('user_id',$request->user_id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,cart $cart)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        //
    }
}
