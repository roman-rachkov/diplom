<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call([
            AttachmentSeeder::class,
            CategorySeeder::class
        ]);

        \App\Models\Product::factory(50)->create();
        \App\Models\ComparedProduct::factory(20)->create();
        \App\Models\Review::factory(70)->create();
    }
}
