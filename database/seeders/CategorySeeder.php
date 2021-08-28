<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voide
     */
    public function run()
    {
        Category::factory()
            ->times(10)
            ->create();

        Category::factory()
            ->count(10)
            ->create();
    }
}
