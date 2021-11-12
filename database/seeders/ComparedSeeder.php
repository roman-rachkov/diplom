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
        $customers = Customer::all();
        $products = Product::all();

        for ($i=0; $i<20; $i++) {
            $customerId = $customers->random()->id;
            $productId = $products->random()->id;

            if(!ComparedProduct::where('customer_id', $customerId)
                ->where('product_id', $productId)
                ->get()
                ->first()
            ) {
                ComparedProduct::factory()->create([
                    'customer_id' => $customerId,
                    'product_id' => $productId,
                ]);
            }

        }
    }
}
