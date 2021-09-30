<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\ViewedProduct;
use Illuminate\Database\Seeder;

class ViewedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = User::all();
        $product = Product::all();

        for ($i=0; $i<rand(20, 30); $i++) {
            ViewedProduct::factory()->create([
                'customer_id' => $customer->random()->id,
                'product_id' => $product->random()->id,
                ]);
        }
    }
}
