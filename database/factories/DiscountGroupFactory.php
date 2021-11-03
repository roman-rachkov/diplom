<?php

namespace Database\Factories;

use App\Models\DiscountGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiscountGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word()
        ];
    }
}
