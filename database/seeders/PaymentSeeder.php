<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentsService;
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
        $services = PaymentsService::all();
        for ($i=0; $i<10; $i++) {
            Payment::factory()->create([
                'order_id' => $order->random()->id,
                'payments_service_id' => $services->random()->id
            ]);
        }
    }
}
