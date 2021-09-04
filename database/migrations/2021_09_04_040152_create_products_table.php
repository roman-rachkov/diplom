<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->unsignedBigInteger('category_id');
            $table->bigInteger('sort_index');
            $table->tinyInteger('limited');
            $table->bigInteger('sales_count');
            $table->unsignedBigInteger('manufacturer_id');
            $table->unsignedBigInteger('main_img_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
