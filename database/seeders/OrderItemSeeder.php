<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = Order::all();
        $product = Order::all();
        $customer = Order::all();
        for ($i=0; $i<50; $i++) {
            OrderItem::factory()->create([
                'order_id' => $order->random()->id,
                'product_id' => $product->random()->id,
                'customer_id' => $customer->random()->id,
            ]);
        }
    }
}
