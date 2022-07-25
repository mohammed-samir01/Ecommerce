<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $adminRole = Role::create(['name'  => 'admin', 'display_name'  => 'Administration', 'description'   => 'Administrator', 'allowed_route' => 'admin']);
        $superVisorRole = Role::create(['name'  => 'supervisor', 'display_name'  => 'Supervisor', 'description'   => 'Supervisor', 'allowed_route' => 'admin']);
        $customerRole = Role::create(['name'    => 'customer', 'display_name'  => 'Customer', 'description'   => 'Customer', 'allowed_route' => null]);

        $admin = User::create([
            'first_name'        => 'Admin',
            'last_name'         => 'System',
            'username'         => 'admin',
            'email'             => 'admin@ecommerce.test',
            'email_verified_at' => now(),
            'mobile'            => '8465466456',
            'password'          => bcrypt('123123123'),
            'user_image'        =>'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10)
        ]);

        $admin->attachRole(@$adminRole);

        $supervisor = User::create([
            'first_name'        => 'Supervisor',
            'last_name'         => 'System',
            'username'         => 'supervisor',
            'email'             => 'supervisor@ecommerce.test',
            'email_verified_at' => now(),
            'mobile'            => '4456468975',
            'password'          => bcrypt('123123123'),
            'user_image'        =>'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10)
        ]);

        $supervisor->attachRole($superVisorRole);


        $customer = User::create([
            'first_name'        => 'Mohamed',
            'last_name'         => 'Samir',
            'username'         => 'hooksha',
            'email'             => 'hooksha@gmail.com',
            'email_verified_at' => now(),
            'mobile'            => '8465466454',
            'password'          => bcrypt('123123123'),
            'user_image'        =>'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10)
        ]);

        $customer->attachRole($customerRole);


        for ($i = 1 ; $i <= 20 ; $i++){

            $random_customer = User::create([
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'username'         => $faker->userName,
                'email'             => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile'            => '8465'.$faker->numberBetween(1000000,9999999),
                'password'          => bcrypt('123123123'),
                'user_image'        =>'avatar.svg',
                'status'            => 1,
                'remember_token'     => Str::random(10)
            ]);

            $random_customer->attachRole($customerRole);

        }

    }
}
