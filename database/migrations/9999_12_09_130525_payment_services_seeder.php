<?php

use App\Models\PaymentsService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentServicesSeeder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
