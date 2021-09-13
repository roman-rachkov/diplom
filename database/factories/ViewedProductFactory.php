<?php

namespace Database\Factories;

use App\Models\ViewedProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewedProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ViewedProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1,100),
            'product_id' => $this->faker->numberBetween(1,100)
        ];
    }
}
