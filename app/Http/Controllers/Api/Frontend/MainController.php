<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use App\Models\Token;
use Illuminate\Http\Request;

class MainController extends Controller
{

    //**********************************create coupon one**********************************
    // public function applyCouponOne(Request $request){
    //     // validation
    //     $rules= [
    //         'products.*.product_id' => 'required|exists:products,id',
    //         'products.*.quantity' => 'required',
    //         'code'=>'required|exists:product_coupons,code',
    //     ];
    //     $validator = validator()->make($request->all(),$rules);
    //     if($validator->fails()){
    //         $error = $validator->errors()->first();
    //         return responseJson(0,'fail',['data'=>$error]);
    //     }


    //     $startDate =ProductCoupon::where('code',$request->code)->first()->start_date;
    //     $startDateAfterEdit =date_create($startDate);

    //     $expireDate =ProductCoupon::where('code',$request->code)->first()->expire_date;
    //     $expireDateAfterEdit =date_create($expireDate);

    //     $nowDate = date_create("now");

    //     // $checkDate = $nowDate<$expireDateAfterEdit;
    //     // return responseJson(0,'test',['startDateAfterEdit'=> $startDateAfterEdit, 'now'=>$nowDate,'check'=>$checkDate]);

    //     if($nowDate >= $startDateAfterEdit  && $nowDate <= $expireDateAfterEdit ){


    //             $code_value = ProductCoupon::where('code',$request->code)->first()->value;    //dicount_value
    //             $costWithoutDicount = 0;
    //             foreach($request->products as $p){
    //                 $product = Product::find($p['product_id']);
    //                 $costWithoutDicount += $p['quantity'] * $product->price;
    //             }

    //             $code_type = ProductCoupon::where('code',$request->code)->first()->type;

    //             if($code_type == 'percentage'){
    //                 $costAfterDiscount = $costWithoutDicount - ($costWithoutDicount*($code_value/100));
    //                                 //600  - (600   *   (50/100)
    //                                 //600  -  (600   *     .5)
    //                                 //600  - 300 = 300 ;
    //             }else{
    //                 $costAfterDiscount = $costWithoutDicount - $code_value;
    //             }


    //             return responseJson(1,'success',['subtotal' => $costWithoutDicount,'total'=>$costAfterDiscount]);

    //     }else{
    //         return responseJson(0,'faild',['data'=>'your coupon may be not started or has been expired']);
    //     }




    // }


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

        // $checkDate = $nowDate<$expireDateAfterEdit;
        // return responseJson(0,'test',['startDateAfterEdit'=> $startDateAfterEdit, 'now'=>$nowDate,'check'=>$checkDate]);

        if($nowDate >= $startDateAfterEdit  && $nowDate <= $expireDateAfterEdit ){


                $code_value = ProductCoupon::where('code',$request->code)->first()->value;    //dicount_value
                $costWithoutDicount = 0;

                $products = Cart::where('user_id',$request->user()->id)->get();
                foreach($products as $p){
                    $product = Product::find($p['product_id']);
                    $costWithoutDicount += $p['quantity'] * $product->price;
                }

                $code_type = ProductCoupon::where('code',$request->code)->first()->type;

                if($code_type == 'percentage'){
                    $costAfterDiscount = $costWithoutDicount - ($costWithoutDicount*($code_value/100));
                                    //600  - (600   *   (50/100)
                                    //600  -  (600   *     .5)
                                    //600  - 300 = 300 ;
                }else{
                    $costAfterDiscount = $costWithoutDicount - $code_value;
                }


                return responseJson(1,'success',['subtotal' => $costWithoutDicount,'total'=>$costAfterDiscount]);

        }else{
            return responseJson(0,'faild',['data'=>'your coupon may be not started or has been expired']);
        }




    }




    //**********************************create order one**********************************
    // public function createOrderOne(Request $request){
    //     // validation
    //     $rules=[
    //         'products.*.product_id' => 'required|exists:products,id',
    //         'products.*.quantity' => 'required',
    //         'user_address_id' => 'required',
    //         'shipping_company_id' =>'required|exists:shipping_companies,id',
    //         'payment_method_id'=>'required',
    //         'tax'=>'required'
    //     ];

    //     $validator = validator()->make($request->all(),$rules);
    //     if($validator->fails()){
    //         $error = $validator->errors()->first();
    //         return responseJson(0,'faild',['data'=>$error]);
    //     }


    //     $shippingCost = ShippingCompany::find($request->shipping_company_id)->first()->cost;

    //     // store order
    //     $order = $request->user()->orders()->create([
    //         'user_address_id' => $request->user_address_id,
    //         'shipping_company_id' => $request->shipping_company_id,
    //         'payment_method_id'=> $request->payment_method_id,
    //         'shipping' => $shippingCost,
    //         'tax' => $request->tax
    //     ]);



    //     $pureCost = 0;  //cost without shipping , tax , discount
    //     $tax = $request->tax;
    //     $discount = 0;

    //     foreach($request->products as $p){
    //         $product = Product::find($p['product_id']);
    //         $readyProduct = $product['product_id'];

    //         $order->products()->attach($readyProduct);
    //         $pureCost += $p['quantity'] * $product->price;
    //     }



    //     if($request->has('coupon_id')){
    //         $productCoupon = ProductCoupon::find($request->coupon_id);

    //         if($productCoupon){
    //             // $productCode = $productCoupon->code;
    //             $startDate =$productCoupon->start_date;
    //             $startDateAfterEdit =date_create($startDate);

    //             $expireDate =$productCoupon->expire_date;
    //             $expireDateAfterEdit =date_create($expireDate);

    //             $nowDate = date_create("now");


    //             if($nowDate >= $startDateAfterEdit  && $nowDate <= $expireDateAfterEdit ){
    //                 $code_type = $productCoupon->type;


    //                 if($code_type == 'percentage'){
    //                     $discount = $pureCost - ($pureCost*($productCoupon->value/100));
    //                                     //600  - (600   *   (50/100)
    //                                     //600  -  (600   *     .5)
    //                                     //600  - 300 = 300 ;
    //                     $order->discount = $discount;
    //                 }else{
    //                     $discount =  $productCoupon->value;
    //                     $order->discount = $discount;
    //                 }

    //             }
    //         }
    //     }

    //     $total_cost = ($pureCost + $tax + $shippingCost) - $discount;

    //     $order->subtotal = $pureCost + $tax + $shippingCost;
    //     $order->total = $total_cost;





    //     $notification = $order->notifications()->create([
    //         'type' => 'order_created'
    //     ]);

    //     $request->user()->notificationsU()->attach($notification->id);

    //     $token = Token::where('user_id',$request->user()->id)->pluck('token')->toArray();
    //     $title = 'new order ';
    //     $order_created_at = $notification->created_at;
    //     $content = 'your order has been sent at '.$order_created_at;

    //     $data = ['yes'=>'send'];

    //     $send = notifyByFirebase($title, $content, $token,$data);
    //     info("firebase result: " . $send);

    //     return responseJson(1,'success',['data' =>$send,'token'=>$token,'order'=>$order,'discount'=>$discount]);




    // }



    //**********************************create order**********************************
    public function createOrder(Request $request){
        // validation
        $rules=[
            'user_address_id' => 'required',
            'shipping_company_id' =>'required|exists:shipping_companies,id',
            'payment_method_id'=>'required',
            'tax'=>'required'
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
            'tax' => $request->tax
        ]);



        $pureCost = 0;  //cost without shipping , tax , discount
        $tax = $request->tax;
        $discount = 0;

        $products = Cart::where('user_id',$request->user()->id)->get();
        foreach($products as $p){
            $product = Product::find($p['product_id']);
            $readyProduct = $product['product_id'];

            $order->products()->attach($readyProduct);
            $pureCost += $p['quantity'] * $product->price;
        }



        if($request->has('coupon_id')){
            $productCoupon = ProductCoupon::find($request->coupon_id);

            if($productCoupon){
                // $productCode = $productCoupon->code;
                $startDate =$productCoupon->start_date;
                $startDateAfterEdit =date_create($startDate);

                $expireDate =$productCoupon->expire_date;
                $expireDateAfterEdit =date_create($expireDate);

                $nowDate = date_create("now");


                if($nowDate >= $startDateAfterEdit  && $nowDate <= $expireDateAfterEdit ){
                    $code_type = $productCoupon->type;


                    if($code_type == 'percentage'){
                        $discount = $pureCost*($productCoupon->value/100);
                                        //600  - (600   *   (50/100)
                                        //600  -  (600   *     .5)
                                        //600  - 300 = 300 ;
                        $order->discount = $discount;
                    }else{
                        $discount =  $productCoupon->value;
                        $order->discount = $discount;
                    }

                }
            }
        }

        $total_cost = ($pureCost + $tax + $shippingCost) - $discount;

        $order->subtotal = $pureCost + $tax + $shippingCost;
        $order->total = $total_cost;





        $notification = $order->notifications()->create([
            'type' => 'order_created'
        ]);

        $request->user()->notificationsU()->attach($notification->id);

        $token = Token::where('user_id',$request->user()->id)->pluck('token')->toArray();
        $title = 'new order ';
        $order_created_at = $notification->created_at;
        $content = 'your order has been sent at '.$order_created_at;

        $data = ['yes'=>'send'];

        $send = notifyByFirebase($title, $content, $token,$data);
        info("firebase result: " . $send);

        return responseJson(1,'success',['data' =>$send,'token'=>$token,'order'=>$order,'discount'=>$discount]);




    }





    //**********************************fav products**********************************
    public function favProducts(Request $request){
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


    //**********************************cart**********************************


    //**********************************show cart**********************************
    public function showCart(Request $request){

        $user_cart= Cart::join('products','products.id','=','carts.product_id')
        ->join('media','media.mediable_id','=','carts.product_id')
        ->where('user_id',$request->user()->id)->get();

        if($user_cart){
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
            return responseJson(1,'fail',['data'=>'error']);
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



    //**********************************delete cart product**********************************
    public function deleteProduct(Request $request){
        // validation
        $rules = ['product_id' => 'required'];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }



         Cart::where('user_id',$request->user()->id)
        ->where('product_id',$request->product_id)
        ->delete();

        return responseJson(1,'succes',['cart'=>'deleted successfuly']);
    }


}



