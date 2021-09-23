<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $attachment = Attachment::all();
        for ($i=0; $i<50; $i++) {
            Product::factory()->create(['main_img_id' => $attachment->random()->id]);
        }
    }
}
