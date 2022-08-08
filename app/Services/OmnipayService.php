<?php


namespace App\Services;


use Omnipay\Omnipay;

class OmnipayService
{
    protected $gateway = '';

    public function __construct($payment_method = 'PayPal_Express')
    {
        if( is_null($payment_method) || $payment_method == 'PayPal_Express'){
            $this->gateway = Omnipay::create('PayPal_Express');
            $this->gateway->setUsername(config('services.paypal.username'));
            $this->gateway->setPassword(config('services.paypal.password'));
            $this->gateway->setSignature(config('services.paypal.signature'));
            $this->gateway->setTestMode(config('services.paypal.sandbox'));
        }
        return $this->gateway;
    }

    public function purchase(array $parameter)
    {
        $response = $this->gateway->purchase($parameter)->send();
        return $response;
    }

    public function refund(array $parameter)
    {
        $response = $this->gateway->refund($parameter)->send();
        return $response;
    }

    public function complete(array $parameter)
    {
        $response = $this->gateway->completePurchase($parameter)->send();
        return $response;
    }

    public function getCancelUrl($order_id)
    {
        return route('checkout.cancel', $order_id);
    }

    public function getReturnUrl($order_id)
    {
        return route('checkout.complete', $order_id);
    }

    public function getNotifyUrl($order_id)
    {
        $env = config('services.paypal.sandbox') ? 'sandbox' : 'live';
        return route('checkout.webhook.ipn', [$order_id, $env]);
    }
}
