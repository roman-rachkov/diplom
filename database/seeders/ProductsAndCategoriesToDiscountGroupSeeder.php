<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountGroup;
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

        $discountGroups = [
            DiscountGroup::factory(['title' => 'many_products_inside'])
                ->hasProducts(5)
                ->create(),
            DiscountGroup::factory(['title' => 'many_products_and_many_cats_inside'])
                ->hasCategories(3)
                ->hasProducts(3)
                ->create(),
            DiscountGroup::factory(['title' => 'just_one_product_inside'])
                ->hasProducts(1)
                ->create()
        ];


        foreach ($discountGroups as $discountGroup) {
            Discount::factory()->create(['discount_group_id' => $discountGroup->id]);
        }


    }
}
