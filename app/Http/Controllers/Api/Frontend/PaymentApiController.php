<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use App\Models\User;
use App\Notifications\Frontend\Customer\OrderCreatedNotification;
use App\Notifications\Frontend\Customer\OrderThanksNotification;
use App\Services\FatoorahServices;
use App\Services\OmnipayService;
use App\Services\OrderApiService;
use App\Services\OrderService;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;


class PaymentApiController extends Controller
{

    use GeneralTrait;

    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }

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


        ############################### Checkout Paypal ###############################

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

                $url = $response->getRedirectUrl();

                return $this->returnData('InvoiceURL', $url,$order);

//               $response->redirect();
            }


        }
        ############################### End Checkout Paypal ###############################

        ############################### Checkout Fatoorah ###############################
        elseif($request->payment_method_id == 2){  // Fatoorah

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

            $data = [
                'CustomerName'       => auth()->user()->full_name,
                'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
                'InvoiceValue'       => $order->total,
                'CustomerEmail'      => auth()->user()->email,
                'CallBackUrl'        => env('success_url'),
                'ErrorUrl'           => env('error_url'),
                'Language'           => 'en', //or 'ar'
                'DisplayCurrencyIso' => 'USD',


            ];

            return  $this->fatoorahServices->sendPayment($data);



        }
        ################################# End Checkout Fatoorah ##############################

        ############################### Checkout Cash on Delivery ###############################
        else{

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

            User::whereHas('roles', function($query) {
                $query->whereIn('name', ['admin', 'supervisor']);
            })->each(function ($admin, $key) use ($order) {
                $admin->notify(new OrderCreatedNotification($order));
            });


            $payment_name = PaymentMethod::where('id',$order->payment_method_id)->get('name')->first();
            $products = $order->products;
            $products = $order->toArray();
            $data = $order->toArray();
            $data['payment_name'] = $payment_name;


            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
            $pdf = PDF::loadView('layouts.invoice_api', $data,$products,$payment_name);
            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
            $pdf->save($saved_file);

            $customer = User::find($order->user_id);
            $customer->notify(new OrderThanksNotification($order, $saved_file));


            return responseJson(1,'success',['order'=>$order,'discount'=>$discount]);

        }

        ################################## End Cash On Delivery##############################

        return responseJson(1,'Error',['message'=>'Error']);

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

        return response()->redirectTo('http://localhost:4200/home',200)->with('success', 'Order Canceled');

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


            User::whereHas('roles', function($query) {
                $query->whereIn('name', ['admin', 'supervisor']);
            })->each(function ($admin, $key) use ($order) {
                $admin->notify(new OrderCreatedNotification($order));
            });


            $payment_name = PaymentMethod::where('id',$order->payment_method_id)->get('name')->first();
            $products = $order->products;
            $products = $order->toArray();
            $data = $order->toArray();
            $data['payment_name'] = $payment_name;


            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
            $pdf = PDF::loadView('layouts.invoice_api', $data,$products,$payment_name);
            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
            $pdf->save($saved_file);

            $customer = User::find($order->user_id);
            $customer->notify(new OrderThanksNotification($order, $saved_file));


            return response()->redirectTo('http://localhost:4200/home',200)->with('success', 'Payment Successful');

        }
    }


    public function callback(Request $request)
    {
        $user = Auth::user();
        $order= Order::where('user_id',$user->id)->latest()->first();

        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'paymentId';
        $paymentData = $this->fatoorahServices->getPaymentStatus($data);
        $paymentData = json_decode($paymentData->content(), true);
        $PaymentId = $paymentData['InvoiceTransactions'][0]['PaymentId'];


        if($paymentData['InvoiceStatus'] == "Paid") {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                'transaction_number' => $PaymentId,
                'payment_result' => 'success'
            ]);
        }

        User::whereHas('roles', function($query) {
            $query->whereIn('name', ['admin', 'supervisor']);
        })->each(function ($admin, $key) use ($order) {
            $admin->notify(new OrderCreatedNotification($order));
        });

        $payment_name = PaymentMethod::where('id',$order->payment_method_id)->get('name')->first();
        $products = $order->products;
        $products = $order->toArray();
        $data = $order->toArray();
        $data['payment_name'] = $payment_name;


        $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
        $pdf = PDF::loadView('layouts.invoice_api', $data,$products,$payment_name);
        $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
        $pdf->save($saved_file);

        $customer = User::find($order->user_id);
        $customer->notify(new OrderThanksNotification($order, $saved_file));


        return 'success';
//        return response()->redirectTo('http://localhost:4200/home',200)->with('success', 'Payment Successful');


    }

    public function error(Request $request)
    {
        $user = Auth::user();
        $order= Order::where('user_id',$user->id)->latest()->first();
        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'paymentId';
        $paymentData = $this->fatoorahServices->getPaymentStatus($data);
        $PaymentId = $paymentData['Data']['InvoiceTransactions'][0]['PaymentId'];
        $TransactionStatus = $paymentData['Data']['InvoiceTransactions'][0]['TransactionStatus'];

        $order->update([
            'order_status' => Order::CANCELED
        ]);
        $order->products()->each(function ($order_product) {
            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $order_product->pivot->quantity
            ]);
        });

        if($TransactionStatus == "Failed") {
            $order->transactions()->create([
                'transaction' => OrderTransaction::CANCELED,
                'transaction_number' => $PaymentId,
                'payment_result' => 'Failed'
            ]);
        }



//        return response()->redirectTo('http://localhost:4200/home',200)->with('success', 'Order Canceled');

    }

}
