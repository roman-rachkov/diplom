<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Orchid\Attachment\Models\Attachment;
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
            'phone' => '9876543210',
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
            CategorySeeder::class,
        ]);

        \App\Models\Customer::factory(50)->create();
        \App\Models\Product::factory(50)->create([
            'main_img_id' => Attachment::all()->random(),
            'category_id' => Category::all()->random(),
        ]);
        \App\Models\ComparedProduct::factory(20)->create();
        \App\Models\Review::factory(70)->create();

        PaymentsService::factory()->create([
            'name' => 'Онлайн картой',
            'service' => '\App\Service\SomeonePaymentService'
        ]);
        PaymentsService::factory()->create([
            'name' => 'Онлайн со случайного чужого счета',
            'service' => '\App\Service\SomeonePaymentService'
        ]);

        Payment::factory(5)->create([
            'payments_service_id' => PaymentsService::all()->random(),
        ]);
        OrderItem::factory(50)->create([
            'order_id' => [Order::all()->random()->id, null][random_int(0, 1)],
        ]);
    }
}
