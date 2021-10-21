<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Orchid\Attachment\Models\Attachment;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachment = Attachment::all();
        for ($i=0; $i<rand(5, 8); $i++) {
            Banner::factory()->create(['image_id' => $attachment->random()->id]);
        }
    }
}
