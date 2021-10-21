<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Seeder;

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
        $categories = Category::all();
        foreach ($categories as $cat) {
            Product::factory(rand(3, 10))->create([
                'main_img_id' => $attachment->random()->id,
                'category_id' => $cat->id
                ]);
        }

    }
}
