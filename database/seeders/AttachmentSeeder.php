<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Attachment\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attachment::factory()
            ->times(40)
            ->create();
    }
}
