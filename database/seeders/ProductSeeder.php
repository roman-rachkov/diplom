<?php

namespace Database\Seeders;

use App\Models\ComparedProduct;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Orchid\Attachment\Models\Attachment;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(10)
            ->hasAttachment(3)
            ->hasPrices(3)
            ->create();
    }
}
