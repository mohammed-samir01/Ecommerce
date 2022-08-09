<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Clothes', 'status' => true]);
        Tag::create(['name' => 'Shoes', 'status' => true]);
        Tag::create(['name' => 'Watches', 'status' => true]);
        Tag::create(['name' => 'Electronics', 'status' => true]);
        Tag::create(['name' => 'Men', 'status' => true]);
        Tag::create(['name' => 'Women', 'status' => true]);
        Tag::create(['name' => 'Boys', 'status' => true]);
        Tag::create(['name' => 'Girls', 'status' => true]);
    }
}
