<?php

namespace Database\Seeders;

use App\Models\ComparedProduct;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory([
                    'name' => 'Administrator',
                    'email' => 'admin@admin.com',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10),
                    'permissions' => [
                        'platform.index' => 1,
                        'platform.systems.roles' => 1,
                        'platform.systems.users' => 1,
                        'platform.systems.attachment' => 1,
                    ],
                ])->create();
        \App\Models\User::factory(10)->create();

        $this->call([
            BannersSeeder::class,

        ]);
        Product::factory(10)->hasAttachment(3)->create();
        ComparedProduct::factory(4)->create();
        Review::factory(10)->create();
    }
}
