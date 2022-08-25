<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from Hooksha"
        ]);
        Session::flash('success','Payment has been successfully');
        return back()->with('success', 'Payment successful!');

    }

}
