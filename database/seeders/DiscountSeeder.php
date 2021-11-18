<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Orchid\Attachment\Models\Attachment;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachment = Attachment::all();

        Discount::factory([
            'method_type' => Discount::METHOD_CLASSIC,
            'image_id' => $attachment->random()->id,
        ])->count(10)->create();
        Discount::factory([
            'method_type' => Discount::METHOD_FIXED,
            'image_id' => $attachment->random()->id,
        ])->count(10)->create();
        Discount::factory([
            'method_type' => Discount::METHOD_SUM,
            'image_id' => $attachment->random()->id,
        ])->count(10)->create();
    }
}
