<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::all();
        for ($i=0; $i<70; $i++) {
            Review::factory()->create(['product_id' => $product->random()->id]);
        }
    }
}
