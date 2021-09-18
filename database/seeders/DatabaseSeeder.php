<?php

namespace Database\Seeders;

use App\Models\ComparedProduct;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Orchid\Platform\Models\Role;

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
            'name' => 'Admininstrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])
            ->has(Role::factory([
                'slug' => 'administrator',
                'name' => 'Администратор',
                'permissions' => [
                    'platform.index' => 1,
                    'platform.systems.roles' => 1,
                    'platform.systems.users' => 1,
                    'platform.systems.attachment' => 1,
                    'platform.systems.settings' => 1,
                    'platform.systems.import' => 1,
                    'platform.elements.banners' => 1,
                    'platform.elements.category' => 1,
                    'platform.elements.products' => 1,
                    'platform.elements.sellers' => 1,
                    'platform.elements.discounts' => 1,
                    'platform.elements.orders' => 1,

                ],
            ]))
            ->has(Role::factory())
            ->create();

        \App\Models\User::factory(10)->create();

        $this->call([
            BannersSeeder::class,
            ProductSeeder::class
        ]);
//
        Customer::factory(50)->create();
        ComparedProduct::factory(20)->create();
        Review::factory(70)->create();

        Payment::factory(5)->create();
        OrderItem::factory(50)->create();
    }
}
