<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryCharacteristicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_characteristic', function (Blueprint $table) {
            $table->unsignedBigInteger('characteristic_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('characteristic_id')
                ->references('id')
                ->on('characteristics')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
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
        Schema::dropIfExists('characteristic_category');
    }
}
