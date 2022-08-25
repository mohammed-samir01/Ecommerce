<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Services\FatoorahServices;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    private $fatoorahServices;
    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }

    public function payOrder()
    {
        $data = [
            'CustomerName'       => 'Mohamed Samir',
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '1000',
            'CustomerEmail'      => 'hookshamosiba201555@gmail.com',
            'CallBackUrl'        => env('success_url'),
            'ErrorUrl'           => env('error_url'),
            'Language'           => 'en', //or 'ar'
            'DisplayCurrencyIso' => 'KWD',


        ];

      return  $this->fatoorahServices->sendPayment($data);

    }

    public function callback(Request $request)
    {
        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'paymentId';
        $paymentData = $this->fatoorahServices->getPaymentStatus($data);
        return $paymentData;
    }

    public function error(Request $request)
    {
        return $request->all();
//        return $paymentData['Data']['InvoiceStatus'];

    }
}
