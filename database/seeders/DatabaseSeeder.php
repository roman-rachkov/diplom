<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
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
            PaymentSeeder::class
        ]);

    }
}
