<?php

namespace Database\Seeders;

use App\Models\Discount;
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
            'method_type' => Discount::METHOD_CLASSIC,
        ])->count(10)->has(Product::factory())->create();
        Discount::factory([
            'method_type' => Discount::METHOD_FIXED,
        ])->count(10)->has(Product::factory())->create();
        Discount::factory([
            'method_type' => Discount::METHOD_SUM,
        ])->count(10)->has(Product::factory())->create();
    }
}
