<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchid\Attachment\Models\Attachment;

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
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(35),
            'full_description' => $this->faker->paragraph(75),
            'slug' => $this->faker->slug(),
            'category_id' => Category::factory(),
            'sort_index' => $this->faker->numberBetween(1,100),
            'limited' => $this->faker->boolean(90),
            'sales_count' => $this->faker->numberBetween(1, 200),
            'manufacturer_id' => Manufacturer::factory(),
            'main_img_id' => Attachment::factory(),
        ];
    }
}
