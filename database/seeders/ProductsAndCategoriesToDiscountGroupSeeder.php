<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountGroup;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductsAndCategoriesToDiscountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Простая скидка с классическим методом расчёта
        DiscountGroup::factory(['title' => 'many_products_and_many_cats_inside'])
            ->hasCategories(3)
            ->hasProducts(3)
            ->for(Discount::factory()->state([
                'method_type' => 'classic',
                'category_type' => 'other',
                'value' => 30.50,
                'weight' => 0,
                'start_at' => Carbon::now(),
                'end_at' => Carbon::now()->addDays(11),
                'is_active' => 1
            ]))
            ->create();


        // Скидка на набор с методом расчёта скидки минус фиксированная сумма
        $discount = Discount::factory([
            'method_type' => 'sum',
            'category_type' => 'set',
            'value' => 300.99,
            'start_at' => Carbon::now(),
            'end_at' => Carbon::now()->addDays(11),
            'is_active' => 1
        ])->create();

        DiscountGroup::factory(['title' => 'group_one_on_set'])
            ->hasCategories(1)
            ->hasProducts(2)
            ->for($discount)
            ->create();

        DiscountGroup::factory(['title' => 'group_two_on_set'])
            ->hasProducts(5)
            ->for($discount)
            ->create();

        // Скидка на корзину с методом расчёта скидки фиксированная цена
        Discount::factory([
            'method_type' => 'fixed',
            'category_type' => 'cart',
            'value' => 1.99,
            'start_at' => Carbon::now(),
            'end_at' => Carbon::now()->addDays(11),
            'is_active' => 1
        ])->create();


    }
}
