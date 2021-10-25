<?php

namespace Database\Seeders;

use App\Models\ComparedProduct;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class ComparedProductsToCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::factory()->create();
        ComparedProduct::factory(['customer_id' => $customer->id])->count(12)->create();
    }
}
