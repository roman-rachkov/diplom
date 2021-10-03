<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('method');
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('payments_service_id');
            $table->foreign('payments_service_id')
                ->references('id')
                ->on('payments_services')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['payments_service_id']);
            $table->dropColumn('payments_service_id');
            $table->string('method');
        });
    }
}
