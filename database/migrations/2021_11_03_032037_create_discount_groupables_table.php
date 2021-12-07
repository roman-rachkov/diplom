<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountGroupablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_groupables', function (Blueprint $table) {
            $table->unsignedBigInteger('discount_group_id');
            $table->unsignedBigInteger('discount_groupable_id');
            $table->string('discount_groupable_type');

            $table->foreign('discount_group_id')
                ->references('id')
                ->on('discount_groups')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_groupables');
    }
}
