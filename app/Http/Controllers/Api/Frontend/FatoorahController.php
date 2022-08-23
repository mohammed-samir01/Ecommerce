<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    public __construct()
    {

    }
    public function payOrder()
    {
        $data = [
            'CustomerName'       => 'fname lname',
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '50',
            'CustomerEmail'      => 'hookshamosiba201555@gmail.com',
            'Language'           => 'en', //or 'ar'
            'DisplayCurrencyIso' => 'KWD',
            'CallBackUrl'        => env('success_url'),
            'ErrorUrl'           => env('error_url'),

        ];


    }
}
