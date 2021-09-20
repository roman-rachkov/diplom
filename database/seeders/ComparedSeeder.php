<?php

namespace Database\Seeders;

use App\Models\ComparedProduct;
use Illuminate\Database\Seeder;

class ComparedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComparedProduct::factory(20)->create();
    }
}
