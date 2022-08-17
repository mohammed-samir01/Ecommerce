<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class MainController extends Controller
{


    //**********************************apply coupon**********************************

    public function applyCoupon(Request $request){

        // validation
        $rules= [
            'code'=>'required|exists:product_coupons,code',

        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }


        $startDate =ProductCoupon::where('code',$request->code)->first()->start_date;
        $startDateAfterEdit =date_create($startDate);

        $expireDate =ProductCoupon::where('code',$request->code)->first()->expire_date;
        $expireDateAfterEdit =date_create($expireDate);

        $nowDate = date_create("now");

        if($nowDate >= $startDateAfterEdit  && $nowDate <= $expireDateAfterEdit ){


            $code_value = ProductCoupon::where('code',$request->code)->first()->value;    //dicount_value
            $pureCost = 0;

            $products = Cart::where('user_id',$request->user()->id)->get();
            foreach($products as $p){
                $product = Product::find($p['product_id']);
                $pureCost += $p['quantity'] * $product->price;
            }

            $coupon = ProductCoupon::where('code',$request->code)->first();

            if($pureCost >= $coupon->greater_than && $coupon->used_times+1 <= $coupon->use_times){

                $code_type = ProductCoupon::where('code',$request->code)->first()->type;

                if($code_type == 'percentage'){
                    $discount = $pureCost*($code_value/100);

                }else{
                    $discount =  $code_value;
                }

                $subTotal = $pureCost;
                $tax =($subTotal-$discount)*(15/100);
                // $shipping = ShippingCompany::find($request->shipping_company_id)->first()->cost;
                $total = ($subTotal + $tax ) - $discount;

                return responseJson(1,'success',['subTotal' => $subTotal,'total'=>$total,'discount'=>$discount,'tax'=>$tax]);
            }else{
                return responseJson(0,'fail',['data' =>'this code is used and finished or your products price is smaller than the min price']);
            }

        }else{
            return responseJson(0,'faild',['data'=>'your coupon may be not started or has been expired']);
        }

    }



//    public function applyCoupon(Request $request){
//        // validation
//        $rules= [
//            'code'=>'required|exists:product_coupons,code',
//            'shipping_company_id' =>'required|exists:shipping_companies,id',
//
//        ];
//        $validator = validator()->make($request->all(),$rules);
//        if($validator->fails()){
//            $error = $validator->errors()->first();
//            return responseJson(0,'fail',['data'=>$error]);
//        }
//
//        $startDate =ProductCoupon::where('code',$request->code)->first()->start_date;
//        $startDateAfterEdit =date_create($startDate);
//
//        $expireDate =ProductCoupon::where('code',$request->code)->first()->expire_date;
//        $expireDateAfterEdit =date_create($expireDate);
//
//        $nowDate = date_create("now");
//
//        if($nowDate >= $startDateAfterEdit  && $nowDate <= $expireDateAfterEdit ){
//
//
//            $code_value = ProductCoupon::where('code',$request->code)->first()->value;    //dicount_value
//            $pureCost = 0;
//
//            $products = Cart::where('user_id',$request->user()->id)->get();
//            foreach($products as $p){
//                $product = Product::find($p['product_id']);
//                $pureCost += $p['quantity'] * $product->price;
//            }
//
//            $coupon = ProductCoupon::where('code',$request->code)->first();
//
//            if($pureCost >= $coupon->greater_than && $coupon->used_times+1 <= $coupon->use_times){
//
//                $code_type = ProductCoupon::where('code',$request->code)->first()->type;
//
//                if($code_type == 'percentage'){
//                    $discount = $pureCost*($code_value/100);
//
//                }else{
//                    $discount = $pureCost - $code_value;
//                }
//
//                $subTotal = $pureCost;
//                $tax =($subTotal-$discount)*(15/100);
//                $shipping = ShippingCompany::find($request->shipping_company_id)->first()->cost;
//                $total = ($subTotal + $tax + $shipping) - $discount;
//
//                return responseJson(1,'success',['subTotal' => $subTotal,'total'=>$total,'discount'=>$discount,'shipping'=>$shipping]);
//            }else{
//                return responseJson(0,'fail',['data' =>'this code is used and finished or your products price is smaller than the min price']);
//            }
//
//        }else{
//            return responseJson(0,'faild',['data'=>'your coupon may be not started or has been expired']);
//        }
//
//    }

    //**********************************create order**********************************
    public function createOrder(Request $request){
        // validation
        $rules=[
            'user_address_id' => 'required',
            'shipping_company_id' =>'required|exists:shipping_companies,id',
            'payment_method_id'=>'required',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'faild',['data'=>$error]);
        }


        $shippingCost = ShippingCompany::find($request->shipping_company_id)->first()->cost;

        // store order
        $order = $request->user()->orders()->create([
            'user_address_id' => $request->user_address_id,
            'shipping_company_id' => $request->shipping_company_id,
            'payment_method_id'=> $request->payment_method_id,
            'shipping' => $shippingCost,
        ]);

        // cash or visa
        if('payment_method_id' == 1){
            $order->order_status = 0;
        }else{
            $order->order_status = 1;
        }

        $pureCost = 0;  //cost without shipping , tax , discount
        $discount = 0;

        $products = Cart::where('user_id',$request->user()->id)->get();
        foreach($products as $p){
            $product = Product::find($p['product_id']);
            $readyProduct = $product->id;

            $order->products()->attach($readyProduct);
            $pureCost += $p['quantity'] * $product->price;
        }


        if($request->has('coupon_id')){
            $productCoupon = ProductCoupon::find($request->coupon_id);

            if($productCoupon){

                $startDate =$productCoupon->start_date;
                $startDateAfterEdit =date_create($startDate);

                $expireDate =$productCoupon->expire_date;
                $expireDateAfterEdit =date_create($expireDate);

                $nowDate = date_create("now");


                if($nowDate >= $startDateAfterEdit  && $nowDate <= $expireDateAfterEdit && $pureCost >= $productCoupon->greater_than && $productCoupon->used_times+1 <= $productCoupon->use_times){
                    $productCoupon->used_times += 1 ;
                    $productCoupon->save();


                    $code_type = $productCoupon->type;

                    if($code_type == 'percentage'){
                        $discount = $pureCost*($productCoupon->value/100);
                        $order->discount = $discount;

                    }else{
                        $discount =  $productCoupon->value;
                        $order->discount = $discount;
                    }

                    $coupon_code = $productCoupon->code;
                    $order->discount_code =$coupon_code;

                }
            }
        }

        $tax = ($pureCost-$discount)*(15/100);
        $total_cost = ($pureCost + $tax + $shippingCost) - $discount;

        $order->subtotal = $pureCost + $tax + $shippingCost;
        $order->total = $total_cost;
        $order->tax = $tax;
        $order->save();

        // make cart empty after creating the order
        Cart::where('user_id',$request->user()->id)->delete();

        return responseJson(1,'success',['order'=>$order,'discount'=>$discount]);

    }

    //**********************************fav products**********************************
    public function toggleFav(Request $request){
        // validation
        $rules=[
            'product_id' => 'required'
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'faild',['data'=>$error]);
        }

        $request->user()->products()->toggle($request->product_id);
        return responseJson(1,'success',['favProducts'=>$request->user()->products]);
    }


    //**********************************get fav**********************************
    public function getFav(Request $request){

        $fav_products = $request->user()->products()->with('media')->get();

        if(count($fav_products)){
            return responseJson(1,'success',['products'=>$fav_products]);
        }else{
            return responseJson(0,'fail',['products'=>'there are no fav products']);
        }
    }

    //**********************************delete fav**********************************
    public function deleteFavProduct(Request $request){
        // validation
        $rules=[
            'product_id' => 'required'
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error =$validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }



        $request->user()->products()->detach($request->product_id);
        return responseJson(1,'success',['message'=>Product::find($request->product_id)->name .'is deleted from your fav']);

    }

    //********************************** add to wishlist **********************************
    public function addFavToCart(Request $request){
        // validation
        $rules=[
            'product_id' => 'required'
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error =$validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }



        $cart = Cart::where('user_id',$request->user()->id)->where('product_id',$request->product_id)->get();

        if(count($cart)){
            return responseJson(0,'fail',['data'=>'product allredy exists in your cart','count'=>$cart]);
        }else{
            $product= product::where('id',$request->product_id)->first();
            if($product){
                $cart = Cart::create([
                    'user_id' => $request->user()->id,
                    'product_id'=>$request->product_id,
                    'price' => $product->price,
                    'quantity'=> 1,
                    'total'=> $product->price
                ]);
                return responseJson(1,'success',['done'=>'fav product added to your cart']);
            }else{
                return responseJson(0,'fail',['data'=>'error']);
            }
        }

    }


    //**********************************cart**********************************

    //**********************************show cart**********************************
    public function showCart(Request $request){

        $user_cart= Cart::
//        join('products','products.id','=','carts.product_id')
            join('media','media.mediable_id','=','carts.product_id')
            ->where('user_id',$request->user()->id)->get();

        if(count($user_cart) > 0){

            return responseJson(1,'success',['data'=>$user_cart]);
        }else{

            return responseJson(0,'fail',['data'=>'cart is empty']);
        }

    }


    //**********************************add to cart**********************************
    public function addToCart(Request $request)
    {
        // validation
        $rules=[
            'product_id' => 'required',
        ];
        $validator =validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }


        $cart = Cart::where('user_id',$request->user()->id)->where('product_id',$request->product_id)->get();

        if(count($cart)){
            return responseJson(0,'fail',['data'=>'product allredy exists in your cart','count'=>$cart]);
        }else{
            $product= product::where('id',$request->product_id)->first();
            if($product){
                $cart = Cart::create([
                    'user_id' => $request->user()->id,
                    'product_id'=>$request->product_id,
                    'price' => $product->price,
                    'quantity'=> 1,
                    'total'=> $product->price
                ]);
                return responseJson(1,'success',['cart'=>$cart]);
            }else{
                return responseJson(0,'fail',['data'=>'error']);
            }
        }
    }

    //**********************************update cart quantity**********************************
    public function updateQuantity(Request $request){
        // validation
        $rules=[
            'quantity' => 'required',
            'product_id' => 'required',
        ];
        $validator =validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }



        $price=Product::where('id',$request->product_id)->first()->price;

        Cart::where('user_id',$request->user()->id)
            ->where('product_id',$request->product_id)
            ->update(['quantity'=>$request->quantity,'total'=>$price*$request->quantity]);



        return responseJson(1,'success',['cart'=>Cart::where('product_id',$request->product_id)->where('user_id',$request->user()->id)->first() ]);
    }



    //**********************************delete cart cart **********************************
    public function deleteProduct(Request $request){
        // validation
        $rules = ['product_id' => 'required'];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }


        $carts =Cart::where('user_id',$request->user()->id)->where('product_id',$request->product_id)->get();
        if(count($carts)){
            Cart::where('user_id',$request->user()->id)->where('product_id',$request->product_id)->delete();
            return responseJson(1,'succes',['cart'=>'deleted successfuly']);
        }else{
            return responseJson(0,'fail',['cart'=>'this product is not exist to be deleted']);
        }

    }

}
