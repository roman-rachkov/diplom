<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\CharacteristicValue;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacteristicValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CharacteristicValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'characteristic_id' => Characteristic::factory(),
            'value' => rand(100, 200)
        ];
    }
}
