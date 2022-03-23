<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Orchid\Platform\Models\Role;

class CreateAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::factory([
            'name' => 'Admininstrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone' => '9876543210'
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
