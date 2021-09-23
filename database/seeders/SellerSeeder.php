<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Orchid\Attachment\Models\Attachment;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachment = Attachment::all();
        for ($i=0; $i<10; $i++) {
            Seller::factory()->create(['logo_id' => $attachment->random()->id]);
        }
    }
}
