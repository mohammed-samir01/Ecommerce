<?php

namespace Database\Seeders;

use App\Models\chat;
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
        chat::create([
            "user_id"=>10
        ]);
    }
}
