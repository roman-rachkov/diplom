<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountIdToDiscountGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')
                ->references('id')
                ->on('discounts')
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
        Schema::table('discount_groups', function (Blueprint $table) {
            $table->dropForeign('discount_id');
        });
    }
}
