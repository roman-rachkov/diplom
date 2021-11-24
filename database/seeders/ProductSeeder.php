<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Seeder;
use Orchid\Attachment\Models\Attachmentable;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $attachments = Attachment::all();
        $categories = Category::all();
        foreach ($categories as $cat) {
            Product::factory(rand(3, 10))->create([
                'main_img_id' => $attachments->random()->id,
                'category_id' => $cat->id,
            ])->each(function (Product $product) use ($attachments) {
                $new = [];
                foreach ($attachments->random(3) as $item) {
                    $new[] = new Attachmentable([
                        'attachmentable_type' => Attachment::class,
                        'attachmentable_id' => $product->id,
                        'attachment_id' => $item->id,
                    ]);
                }
                $product->additionalImages()->saveMany($new);
            });
        }

    }
}
