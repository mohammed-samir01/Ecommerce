<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Token;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // create order
    public function createOrder(Request $request){
        // validation
        $rules=[
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required',
            'user_address_id' => 'required',
            'shipping_company_id' =>'required',
            'payment_method_id'=>'required',
            'discount'=>'required',
            'shipping'=>'required',
            'tax'=>'required'
        ];

        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'faild',['data'=>$error]);
        }


        // create order
        $order = $request->user()->orders()->create([
            'user_address_id' => $request->user_address_id,
            'shipping_company_id' => $request->shipping_company_id,
            'payment_method_id'=> $request->payment_method_id,
            'discount' => $request->discount,
            'shipping' => $request->shipping,
            'tax' => $request->tax
        ]);



        $pureCost = 0;
        $tax = $request->tax;
        $shipping = $request->shipping;
        $discount = $request->discount;

        foreach($request->products as $product){
            $product = Product::find($product['product_id']);
            $readyProduct = $product['product_id'];

            $order->products()->attach($readyProduct);
            $pureCost += $product['quantity'] * $product->price;
        }



        $total_cost = ($pureCost + $tax + $shipping) - $discount;

        $order->subtotal = $pureCost + $tax + $shipping;
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

        return responseJson(1,'success',['data' =>$send,'token'=>$token]);

    }






}



