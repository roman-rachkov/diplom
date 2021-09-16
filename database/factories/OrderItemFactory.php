<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'product_id' => Price::factory(),
            'quantity' => $this->faker->randomDigitNotZero(),
            'sum' => $this->faker->randomFloat(2, 1, 1000),
            'customer_id' => Customer::factory(),
        ];
    }
}
