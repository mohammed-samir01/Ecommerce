<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'paypal' => [
        'username'  => 'sb-shbvk18063048_api1.business.example.com',
        'password'  => '5XVJX4GEM32VEUER',
        'signature' => 'Ai9pZWO7HELsWF2nYCZXKt9ryPoRACL1H.QYdL0ZllgxD-ztnpdzJQQ0',
        'sandbox'   => true,
    ],
    'facebook' => [
        'client_id' =>'1690073798073481',
        'client_secret' =>'db28cdbd7e375f4984270d67139d17e9',
        'redirect' => 'https://ecommerce.test/login/facebook/callback',
    ],
    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
    ],

];
