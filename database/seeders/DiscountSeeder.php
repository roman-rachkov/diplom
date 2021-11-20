<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::factory([
            'category_type' => Discount::CATEGORY_OTHER,
        ])->has(
            DiscountGroup::factory()
                ->count(1)
                ->afterCreating(function ($group) {
                    $products = Product::all()->random(random_int(0, 10));
                    $categories = Category::all()->random(random_int(0, 10));
                    $group->products()->attach($products);
                    $group->categories()->attach($categories);
                })
        )->count(10)->create();

        Discount::factory([
            'category_type' => Discount::CATEGORY_SET,
        ])->count(10)->afterCreating(function ($discount) {
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
