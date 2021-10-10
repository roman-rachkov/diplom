<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(2, 1, 99),
            'type' => $this->faker->randomElement(['classic', 'sum', 'fix']),
            'weight' => random_int(0, 100),
            'minimal_cost' => $this->faker->randomFloat(2, 0, 10000),
            'start_at' => $this->faker->date(),
            'end_at' => $this->faker->date(),
            'is_active' => random_int(0, 1),
        ];
    }
}
