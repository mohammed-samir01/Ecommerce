<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart;




class OrderApiService
{
    public function createOrder($request){

        // validation
        $rules=[
            'user_address_id' => 'required',
            'shipping_company_id' =>'required|exists:shipping_companies,id',
            'payment_method_id'=>'required',
        ];

        $validator = validator()->make($request->all(), $rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'failed',['data'=>$error]);
        }

            $shippingCost = ShippingCompany::find($request->shipping_company_id)->first()->cost;

            // store order
            $order = $request->user()->orders()->create([
                'ref_id' => 'ORD-' . Str::random(15),
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
//            $order->save();

        $order->transactions()->create([
            'transaction' => OrderTransaction::NEW_ORDER
        ]);

            return  $order;

//            // make cart empty after creating the order
//            Cart::where('user_id',$request->user()->id)->delete();
//
//            return responseJson(1,'success',['order'=>$order,'discount'=>$discount]);

        }

}
