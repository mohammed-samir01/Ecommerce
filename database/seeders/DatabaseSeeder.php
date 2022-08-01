<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'salma shehata',
            'email'=>'salmaemam52@gmail.com',
            'email_verified_at'=>now(),
            'password'=>bcrypt('123123123'),
            'remember_token'=>Str::random(10),
        ]);
        User::create([
            'name'=>'mohmmed samir',
            'email'=>'samir2@gmail.com',
            'email_verified_at'=>now(),
            'password'=>bcrypt('123123123'),
            'remember_token'=>Str::random(10),
        ]);
        User::create([
            'name'=>'hager mohammed',
            'email'=>'hager2@gmail.com',
            'email_verified_at'=>now(),
            'password'=>bcrypt('123123123'),
            'remember_token'=>Str::random(10),
        ]);
        User::create([
            'name'=>'mo emad',
            'email'=>'Emad52@gmail.com',
            'email_verified_at'=>now(),
            'password'=>bcrypt('123123123'),
            'remember_token'=>Str::random(10),
        ]);
       
    }
}
