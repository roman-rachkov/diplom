<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'full_name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'delivery_type' => $this->faker->randomElement(['default', 'express']),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'total' => $this->faker->randomFloat(2, 1, 1000),
            'comment' => $this->faker->realTextBetween(20, 200)
        ];
    }
}
