<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::all();

        for ($i=0; $i<25; $i++) {
            Order::factory()->create(['customer_id' => $customer->random()->id]);
        }
    }
}
