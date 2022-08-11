<?php

namespace App\Http\Controllers;

use App\Http\Resources\General\CartResource;
use App\Models\cart;
use App\Models\User;
use App\Models\product;
use App\Models\media;

use Illuminate\Http\Request;

class CartController extends Controller
{

    public function display(Request $request){
        $user_cart= cart::join('products','products.id','=','carts.product_id')
        ->join('media','media.mediable_id','=','carts.product_id')
        ->where('user_id',$request->user_id)->get();

        if($user_cart){
            return $user_cart;
        }else{
           return response()->json([ 'message'=>'your cart is empty']);
        }


  }
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
                'cart_price'=>$price
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
        ->update(['cart_quantity'=>$request->quantity,'cart_price'=>$price*$request->quantity]);
         return cart::all()->where('user_id',$request->user_id)->where('product_id',$request->product_id);
    }
    public function deletecartproduct(Request $request){
        cart::where('user_id',$request->user_id)
        ->where('product_id',$request->product_id)
        ->delete();
        return cart::all()->where('user_id',$request->user_id);
    }
}
