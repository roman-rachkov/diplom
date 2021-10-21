<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\CharacteristicValue;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductWithCharacteristicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::factory(
            [
                'name' => 'smartphones'
            ])
            ->has(Characteristic::factory()->count(10))
            ->create();

        $products = Product::factory(
            [
                'category_id' => $category->id,
                'main_img_id' => 1
            ])
            ->hasPrices(3)
            ->count(10)
            ->create();

        foreach ($products as $product) {
            foreach ($category->characteristics as $characteristic) {
                CharacteristicValue::factory(
                    [
                        'product_id' => $product->id,
                        'characteristic_id' => $characteristic->id
                    ])
                    ->create();
            }
        }
    }
}
