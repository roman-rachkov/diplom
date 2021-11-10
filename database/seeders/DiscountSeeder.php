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
                ->hasAttached(Product::all()->random(random_int(0, 10)))
                ->hasAttached(Category::all()->random(random_int(0, 10)))
//                ->hasProducts(random_int(0, 10))
//                ->hasCategories(random_int(0, 10))
        )->count(10)->create();

        Discount::factory([
            'category_type' => Discount::CATEGORY_SET,
        ])->has(
            DiscountGroup::factory()
                ->count(random_int(1, 5))
                ->hasAttached(Product::all()->random(random_int(0, 10)))
                ->hasAttached(Category::all()->random(random_int(0, 10)))
//                ->hasProducts(random_int(0, 10))
//                ->hasCategories(random_int(0, 10))
        )->count(10)->create();

        Discount::factory([
            'category_type' => Discount::CATEGORY_CART,
        ])->count(10)->create();
    }
}
