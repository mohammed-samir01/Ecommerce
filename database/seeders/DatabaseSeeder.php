<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\conversation;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversation_user')->insert([
            'conversation_id'=>1,
            'user_id'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
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
        conversation::create([
            'name'=>'clothes',
            'uuid'=>Str::uuid(),
            'user_id'=>1,

        ]);
        conversation::create([
            'name'=>'food',
            'uuid'=>Str::uuid(),
            'user_id'=>1,

        ]);
        conversation::create([
            'name'=>'school',
            'uuid'=>Str::uuid(),
            'user_id'=>1,

        ]);

    }
}
