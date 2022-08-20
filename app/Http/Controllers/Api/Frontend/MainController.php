<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\Customer\ShowOrderResource;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use App\Models\State;
use App\Models\User;
use App\Models\UserAddress;
use App\Notifications\Frontend\Customer\OrderCreatedNotification;
use App\Notifications\Frontend\Customer\OrderThanksNotification;
use App\Services\OmnipayService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use function Clue\StreamFilter\fun;

class MainController extends Controller
{

    use GeneralTrait;

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
            return responseJson(0,'failed',['data'=>$error]);
        }


        if ($request->payment_method_id == 1 ){

            $shippingCost = ShippingCompany::find($request->shipping_company_id)->first()->cost;

            // store order
            $order = $request->user()->orders()->create([
                'user_address_id' => $request->user_address_id,
                'shipping_company_id' => $request->shipping_company_id,
                'payment_method_id'=> $request->payment_method_id,
                'shipping' => $shippingCost,
            ]);

//             cash or visa
            if('payment_method_id' == 1){
                $order->order_status = 1;
            }else{
                $order->order_status =2 ;
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

//            // make cart empty after creating the order
//            Cart::where('user_id',$request->user()->id)->delete();

            $omniPay = new OmnipayService('PayPal_Express');
            $response = $omniPay->purchase([
                'amount' => $order->total,
                'transactionId' => $order->ref_id,
                'currency' => 'USD',
                'cancelUrl' => $omniPay->getCancelUrl($order->id),
                'returnUrl' => $omniPay->getReturnUrl($order->id),
            ]);

            if ($response->isRedirect()) {
                $response->redirect();
            }

//            toast($response->getMessage(), 'error');
//            return redirect()->route('frontend.index');

            // make cart empty after creating the order
            Cart::where('user_id',$request->user()->id)->delete();

            return responseJson(1,'success',['order'=>$order,'discount'=>$discount]);


        }else{

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

    }


    //********************************** Canceled Payment **********************************

    public function cancel($order_id)
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

        return responseJson(200,'success','Cancel');

         redirect()->back();

//        toast('You have cancelled your order payment!', 'error');
//        return redirect()->route('frontend.index');

    }

    //********************************** Completed Payment **********************************

    public function complete($order_id)
    {
        $order = Order::with('products', 'user', 'payment_method')->find($order_id);

        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->complete([
            'amount' => $order->total,
            'transactionId' => $order->ref_id,
            'currency' => $order->currency,
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

            if (session()->has('coupon')) {
                $coupon = ProductCoupon::whereCode(session()->get('coupon')['code'])->first();
                $coupon->increment('used_times');
            }


            session()->forget([
                'coupon',
                'saved_customer_address_id',
                'saved_shipping_company_id',
                'saved_payment_method_id',
                'shipping',
            ]);

            User::whereHas('roles', function($query) {
                $query->whereIn('name', ['admin', 'supervisor']);
            })->each(function ($admin, $key) use ($order) {
                $admin->notify(new OrderCreatedNotification($order));
            });


            $data = $order->toArray();
            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
            $pdf = PDF::loadView('layouts.invoice', $data);
            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
            $pdf->save($saved_file);

            $customer = User::find($order->user_id);
            $customer->notify(new OrderThanksNotification($order, $saved_file));

            return responseJson(200,'success','Complete');

            redirect()->back();

//            toast('Your recent payment is successful with reference code: ' . $response->getTransactionReference(), 'success');
//            return redirect()->route('frontend.index');
        }
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

    //********************************** show cart **********************************
    public function showCart(Request $request){


        $products = Cart::where('user_id',$request->user()->id)->get();
        $cart = CartResource::collection($products);

        if(count($cart) > 0){

            return $this->returnData('Products',$cart,'Success');
        }else{

            return $this->returnError('200','Cart Is Empty') ;
        }

    }


    //********************************** add to cart **********************************

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

    //********************************** update cart quantity **********************************

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



    //********************************** delete cart cart **********************************

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

    //*********** get user Addresses ***********

    public function getUserAddresses(Request $request){
        $addresses = $request->user()->addresses()->get();
        if(count($addresses) > 0 ){
            return responseJson(1,'success',['data'=>$addresses]);
        }else{
            return responseJson(0,'fail',['data'=>'you have not addresses']);
        }
    }

    ########################## get user Address #################################

    public function getUserAddress(Request $request,$address_id){

        $userAddress = UserAddress::find($address_id);

        if($userAddress){

            return $this->returnData('userAddress',$userAddress,'edit');
        }else{

            return $this->returnData('userAddress','Not Found User Address','Success');
        }
    }

    //*********** add user Addresses***********

    public function addUserAddress(Request $request){

        // validation
        $rules = [
            'address_title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'zip_code' => 'required|numeric|min:10000|max:99999',
            'po_box' => 'required|numeric|min:1000|max:9999',
        ];

        $validator = validator()->make($request->all(),$rules);

        if($validator->fails()) {
            $error = $validator->messages();
            return response()->json([
                'success'=> false,
                'error'=> $error,
            ]);
        }

        $address =  auth()->user()->addresses()->create([
                    "address_title" => $request->address_title,
                    "default_address" => $request->default_address,
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "email" => $request->email,
                    "mobile" => $request->mobile,
                    "address" => $request->address,
                    "address2" => $request->address2,
                    "country_id" => $request->country_id,
                    "state_id" => $request->state_id,
                    "city_id" => $request->city_id,
                    "zip_code" => $request->zip_code,
                    "po_box" => $request->po_box,
        ]);

        if ($request->default_address) {

            auth()->user()->addresses()->where('id', '!=', $address->id)->update([
                'default_address' => false
            ]);
        }

      return  $this->returnData('message',$address,'address added successfully');


    }


    //*********** update user Addresses***********

    public function updateUserAddress(Request $request,$address_id){


        $userAddress = UserAddress::find($address_id);
        $userAddress->update($request->all());
        return responseJson(1,'success',['data'=> 'address updated successfully']);
    }


    //***********delete user address***********

    public function deleteUserAddress($id)
    {
        $address = auth()->user()->addresses()->where('id', $id);

        $address->delete();

        return responseJson(1,'Deleted Successfully',['address'=>$id]);
    }

    //***********get user orders***********

    public function getUserOrders(Request $request){
        $orders = $request->user()->orders()->get();
        if(count($orders) > 0){
            return responseJson(1,'success', ['data'=>$orders]);
        }else{
            return responseJson(0,'fail',['data'=>'you did not make any orders']);
        }
    }

    //***********delete user orders***********

    public function deleteUserOrders(Request $request){
        $orders = $request->user()->orders()->get();
        if(count($orders) > 0){
            $request->user()->orders()->delete();
            return responseJson(1,'success', ['data'=>'deleted successfully']);
        }else{
            return responseJson(0,'fail',['data'=>'you did not make any orders']);
        }

    }

    //***********delete user one order***********

    public function deleteUserOrder(Request $request){
        // validation
        $rules = [
            'order_id'=>'required'
        ];
        $validator = validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }


        $order = $request->user()->orders()->where('id',$request->order_id)->first();
        if($order){
            $order->delete();
            return responseJson(1,'success', ['data'=>'deleted successfully']);
        }else{
            return responseJson(0,'fail',['data'=>'order_id does not exist']);
        }

    }


    ########################## show user Order ##################################


    public function showUserOrder(Request $request,$order_id){

        $order = Order::with('products','transactions')->find($order_id);

//        return new ShowOrderResource($order);

        return responseJson(1,'success',['data'=>$order]);
    }


    ########################## show countries ##################################

    public function countries()
    {

        $countries = Country::all();
        return  $this->returnData('Cities',$countries,'Success',200);

    }


    ########################## show states ##################################


    public function states($country_id)
    {

        $state =  State::whereCountryId($country_id)->get();
        return  $this->returnData('Cities',$state,'Success',200);

    }

    ########################## show cities ##################################

    public function cities($state_id)
    {
        $city =  City::whereStateId($state_id)->get();
        return  $this->returnData('Cities',$city,'Success',200);

    }


    ########################## show shipping Compinies  ########################


    public function shippingCompines()
    {
        $shipping_compines =  ShippingCompany::all();
        return  $this->returnData('Shipping_compines',$shipping_compines,'Success',200);

    }

  ########################## show paymentMethods  ################################


    public function paymentMethods()
    {
        $payment_methods =  PaymentMethod::all();
        return  $this->returnData('payment_methods',$payment_methods,'Success',200);

    }
}
