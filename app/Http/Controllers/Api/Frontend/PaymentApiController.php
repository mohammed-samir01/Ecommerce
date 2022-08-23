<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use App\Models\User;
use App\Notifications\Frontend\Customer\OrderCreatedNotification;
use App\Notifications\Frontend\Customer\OrderThanksNotification;
use App\Services\OmnipayService;
use App\Services\OrderApiService;
use App\Services\OrderService;
use App\Models\Cart;
use Illuminate\Support\Str;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;


class PaymentApiController extends Controller
{


    public function checkout_now(Request $request){

        // validation
        $rules=[
            'user_address_id' => 'required',
            'shipping_company_id' =>'required|exists:shipping_companies,id',
            'payment_method_id'=>'required',
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'failed',['data'=>$error]);
        }


        if ($request->payment_method_id == 1 ){       // Paypal

            $shippingCost = ShippingCompany::find($request->shipping_company_id)->first()->cost;

            // store order
            $order = $request->user()->orders()->create([
                'ref_id' => 'ORD-' . Str::random(15),
                'user_address_id' => $request->user_address_id,
                'shipping_company_id' => $request->shipping_company_id,
                'payment_method_id'=> $request->payment_method_id,
                'shipping' => $shippingCost,
                'order_status' => Order::NEW_ORDER,
            ]);

            if($request->payment_method_id == 1){
                $order->order_status = 1;
            }else{
                $order->order_status = 0;
            }

            $pureCost = 0;  //cost without shipping , tax , discount
            $discount = 0;

            $products = Cart::where('user_id',$request->user()->id)->get();


            foreach($products as $p){
                $product = Product::find($p['product_id']);
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

            foreach ($products as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity
                ]);
                $product = Product::find($item->id);
                $product->update(['quantity' => $product->quantity - $item->quantity]);
            }

            $order->transactions()->create([
                'transaction' => OrderTransaction::NEW_ORDER
            ]);

            $order->save();


            // make cart empty after creating the order
            Cart::where('user_id',$request->user()->id)->delete();

            $omniPay = new OmnipayService('PayPal_Express');
            $response = $omniPay->purchase([
                'amount' => $order->total,
                'transactionId' => $order->ref_id,
                'currency' => 'USD',
                'cancelUrl' => $omniPay->getCancelUrl($order->id),
                'returnUrl' => $omniPay->getReturnUrl($order->id),
            ]);

            if ($response->isRedirect()) {

                return response()->json($response->getRedirectUrl());
//                $response->redirect();
            }


        }else{

            $shippingCost = ShippingCompany::find($request->shipping_company_id)->first()->cost;

            // store order
            $order = $request->user()->orders()->create([
                'ref_id' => 'ORD-' . Str::random(15),
                'user_address_id' => $request->user_address_id,
                'shipping_company_id' => $request->shipping_company_id,
                'payment_method_id'=> $request->payment_method_id,
                'shipping' => $shippingCost,
                'order_status' => Order::NEW_ORDER,

            ]);


            $pureCost = 0;  //cost without shipping , tax , discount
            $discount = 0;

            $products = Cart::where('user_id',$request->user()->id)->get();


            foreach($products as $p){
                $product = Product::find($p['product_id']);
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




            foreach ($products as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity
                ]);
                $product = Product::find($item->id);
                $product->update(['quantity' => $product->quantity - $item->quantity]);
            }

            $order->transactions()->create([
                'transaction' => OrderTransaction::NEW_ORDER
            ]);

            $order->save();


            // make cart empty after creating the order
            Cart::where('user_id',$request->user()->id)->delete();

            return responseJson(1,'success',['order'=>$order,'discount'=>$discount]);

        }

        return responseJson(1,'success',['order'=>$order,'discount'=>$discount]);

    }

    public function cancelled($order_id)
    {

        $order = Order::find($order_id);
        $order->update([
            'order_status' => Order::CANCELED
        ]);
        $order->products()->each(function ($order_product) {
            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $order_product->pivot->quantity
            ]);
        });

        return responseJson(1,'Cancelled',['order'=>$order]);

    }

    public function completed($order_id)
    {
        $order = Order::with('products', 'user', 'payment_method')->find($order_id);

        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->complete([
            'amount' => $order->total,
            'transactionId' => $order->ref_id,
            'currency' => 'USD',
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id),
            'notifyUrl' => $omniPay->getNotifyUrl($order->id),
        ]);

        if ($response->isSuccessful()) {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                'transaction_number' => $response->getTransactionReference(),
                'payment_result' => 'success'
            ]);


//            User::whereHas('roles', function($query) {
//                $query->whereIn('name', ['admin', 'supervisor']);
//            })->each(function ($admin, $key) use ($order) {
//                $admin->notify(new OrderCreatedNotification($order));
//            });


//            $data = $order->toArray();
//            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
//            $pdf = PDF::loadView('layouts.invoice', $data);
//            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
//            $pdf->save($saved_file);
//
//            $customer = User::find($order->user_id);
//            $customer->notify(new OrderThanksNotification($order, $saved_file));


            return responseJson(1,'success',['order'=>$order]);


        }
    }

    public function webhook($order, $env)
    {
        //
    }

}
