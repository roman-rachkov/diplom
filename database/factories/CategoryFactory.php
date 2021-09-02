<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    protected $categoryNames;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryNames = [
            'Accessories',
            'Bags',
            'Cameras',
            'Clothing',
            'Electronics',
            'Fashion',
            'Furniture',
            'Mobile',
            'Trends',
            'More'
        ];

        return [
            'name' => $this->faker->randomElement($categoryNames),
            'image_id' => $this->faker->numberBetween(1,300),
            'sort_index' => $this->faker->numberBetween(0, 101),
            'is_active' => $this->faker->boolean(50),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $categories = Category::where('is_active', 1)->whereIsRoot()->get();
            if (
                $this->faker->boolean(70) &&
                $categories->isNotEmpty()
            ) {
                $parent = $categories->random();
                if ($parent->id !== $category->id) {
                    $category->parent()->associate($parent)->save();
                }
            }
        });
    }
}
