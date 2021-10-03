<?php

namespace Database\Seeders;

use App\Models\PaymentsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Redis;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Redis::flushall();
        $this->call([
            UserSeeder::class,
            AttachmentSeeder::class,
            BannersSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            SellerSeeder::class,
            PriceSeeder::class,
            ReviewSeeder::class,
            ViewedProductSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            ComparedSeeder::class,
            PaymentsServiceSeeder::class,
            PaymentSeeder::class
        ]);

    }
}
