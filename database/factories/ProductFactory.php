<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word();
        return [
            'name' => $name,
            'description' => $this->faker->sentence(),
            'slug' => Str::slug($name),
            'category_id' => Category::factory(),
            'sort_index' => $this->faker->numberBetween(1,100),
            'limited' => $this->faker->boolean(90),
            'sales_count' => $this->faker->numberBetween(1, 200),
            'manufacturer_id' => Manufacturer::factory(),
            'main_img_id' => Attachment::factory()
        ];
    }
}
