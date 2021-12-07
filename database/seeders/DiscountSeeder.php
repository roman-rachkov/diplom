<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $validDiscountDates = [
            'start_at' => Carbon::yesterday(),
            'end_at' => Carbon::now()->addDays(30)
        ];

        Discount::factory(
            array_merge(
                [
                    'category_type' => Discount::CATEGORY_OTHER,
                ],
                $validDiscountDates)
        )->has(
            DiscountGroup::factory()
                ->count(1)
                ->afterCreating(function ($group) {
                    $products = Product::all()->random(random_int(0, 10));
                    $categories = Category::all()->random(random_int(0, 10));
                    $group->products()->attach($products);
                    $group->categories()->attach($categories);
                })
        )->count(10)->create();

        Discount::factory(
            array_merge(
                [
                    'category_type' => Discount::CATEGORY_SET,
                ],
                $validDiscountDates)
        )->count(10)->afterCreating(function ($discount) {
            DiscountGroup::factory([
                'discount_id' => $discount
            ])
                ->count(random_int(2, 5))
                ->afterCreating(function ($group) {
                    $products = Product::all()->random(random_int(0, 10));
                    $categories = Category::all()->random(random_int(0, 10));
                    $group->products()->attach($products);
                    $group->categories()->attach($categories);
                })->create();
        })->create();

        Discount::factory([
            'category_type' => Discount::CATEGORY_CART,
        ])->count(10)->create();
    }
}
