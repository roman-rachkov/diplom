<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchid\Attachment\Models\Attachment;

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
            'image_id' => Attachment::all()->random()->id,
            'sort_index' => $this->faker->numberBetween(0, 101),
            'is_active' => $this->faker->boolean(90),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $categories = Category::where('is_active', 1)->get();
            if (
                $this->faker->boolean(70) &&
                $categories->isNotEmpty()
            ) {
                $parent = $categories->random();
                if ($parent->id !== $category->id && !$parent->isDescendantOf($category)) {
                    $category->parent()->associate($parent)->save();
                }
            }
        });
    }
}
