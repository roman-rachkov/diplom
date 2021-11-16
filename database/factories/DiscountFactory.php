<?php

namespace Database\Factories;

use App\Models\Discount;
use App\Models\DiscountGroup;
use Carbon\Carbon;
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
        $startAt = $this->faker->date;
        $minimalCost = $this->faker->randomFloat(2, 0, 10000);
        $minimumQty = random_int(1, 100);
        return [
            'value' => $this->faker->randomFloat(2, 1, 99),
            'method_type' => $this->faker->randomElement(Discount::getMethodTypes()),
            'category_type' => $this->faker->randomElement(Discount::getCategoryTypes()),
            'weight' => random_int(0, 100),
            'minimal_cost' => $minimalCost,
            'maximum_cost' => $minimalCost + $this->faker->randomFloat(2, 0, 10000),
            'minimum_qty' => $minimumQty,
            'maximum_qty' => $minimumQty + random_int(1,100),
            'start_at' => $startAt,
            'end_at' => Carbon::parse($startAt)->addDays(random_int(1,10)),
            'is_active' => random_int(0, 1),
            'description' => $this->faker->sentence(35)
        ];
    }
}
