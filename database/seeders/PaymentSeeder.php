<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = Order::all();
        for ($i=0; $i<10; $i++) {
            Payment::factory()->create(['order_id' => $order->random()->id]);
        }
    }
}
