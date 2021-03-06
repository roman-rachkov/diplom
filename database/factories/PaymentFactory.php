<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'payments_service_id' => PaymentsService::factory(),
            'comment' => $this->faker->realText(40),
            'status' => $this->faker->randomElement(['pending', 'waiting_for_capture', 'succeeded', 'canceled']),
            'payed_at' => $this->faker->randomElement([Carbon::now(), null]),
        ];
    }
}
