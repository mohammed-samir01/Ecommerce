<?php

namespace Database\Seeders;

use App\Models\chat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::all('id') as $user){
            if($user->id==1){}
            else{
            chat::create([
                "user_id"=>$user->id
            ]);}
        }
    }
}
