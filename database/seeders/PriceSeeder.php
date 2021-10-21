<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $sellers = Seller::all();
        foreach ($products as $product) {
            foreach ($sellers->random(2, count($sellers)) as $seller) {
                Price::factory()->create([
                    'product_id' => $product->id,
                    'seller_id' => $seller->id,
                ]);
            }
        }
    }
}
