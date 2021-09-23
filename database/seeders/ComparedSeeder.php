<?php

namespace Database\Seeders;

use App\Models\ComparedProduct;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ComparedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::all();
        $product = Product::all();

        for ($i=0; $i<20; $i++) {
            ComparedProduct::factory()->create([
                'customer_id' => $customer->random()->id,
                'product_id' => $product->random()->id,
            ]);
        }

    }
}
