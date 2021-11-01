<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDiscountablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discountables', function (Blueprint $table) {
            $table->dropColumn('group');
            $table->unsignedBigInteger('discount_group_id');
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
        Schema::table('discountables', function (Blueprint $table) {
            //
        });
    }
}
