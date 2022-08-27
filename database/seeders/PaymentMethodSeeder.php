<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'id'                        => 1,
            'name'                      => 'PayPal',
            'code'                      => 'PPEX',
            'driver_name'               => 'PayPal_Express',
            'merchant_email'            => null,
            'username'                  => null,
            'password'                  => null,
            'secret'                    => null,
            'sandbox_merchant_email'    => null,
            'sandbox_username'          => null,
            'sandbox_password'          => null,
            'sandbox_secret'            => null,
            'sandbox'                   => true,
            'status'                    => true,
        ]);

        PaymentMethod::create([
            'id'                        => 2,
            'name'                      => 'Fatoorah',
            'code'                      => 'Visa $ MasterCard',
            'driver_name'               => 'Visa_MasterCard',
            'merchant_email'            => null,
            'username'                  => null,
            'password'                  => null,
            'secret'                    => null,
            'sandbox_merchant_email'    => null,
            'sandbox_username'          => null,
            'sandbox_password'          => null,
            'sandbox_secret'            => null,
            'sandbox'                   => true,
            'status'                    => true,
        ]);

        PaymentMethod::create([
            'id'                        => 3,
            'name'                      => 'Cash on Delivery',
            'code'                      => 'COD',
            'driver_name'               => 'Cash_on_Delivery',
            'merchant_email'            => null,
            'username'                  => null,
            'password'                  => null,
            'secret'                    => null,
            'sandbox_merchant_email'    => null,
            'sandbox_username'          => null,
            'sandbox_password'          => null,
            'sandbox_secret'            => null,
            'sandbox'                   => true,
            'status'                    => true,
        ]);

    }
}
