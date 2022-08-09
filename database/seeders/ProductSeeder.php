<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $categories = ProductCategory::whereNotNull('parent_id')->pluck('id');

        for ($i = 1; $i <= 1000; $i++) {
            $products[] = [
                'name'                  => $faker->sentence(2, true),
                'slug'                  => $faker->unique()->slug(2, true),
                'description'           => $faker->paragraph,
                'price'                 => $faker->numberBetween(5, 200),
                'quantity'              => $faker->numberBetween(10, 100),
                'product_category_id'   => $categories->random(),
                'featured'              => rand(0, 1),
                'status'                => true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ];
        }

        $chunks = array_chunk($products, 100);
        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }
    }
}
