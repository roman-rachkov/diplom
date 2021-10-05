<?php

namespace Database\Seeders;

use App\Models\PaymentsService;
use Illuminate\Database\Seeder;

class PaymentsServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentsService::factory()->create([
            'name' => 'Онлайн картой',
            'service' => '\App\Service\Payment\OnlinePaymentService',
        ]);
        PaymentsService::factory()->create([
            'name' => 'Онлайн со случайного чужого счета',
            'service' => '\App\Service\Payment\SomeonePaymentService',
        ]);
    }
}
