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
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->integer('sort_index')->nullable();
            $table->tinyInteger('limited');
            $table->integer('sales_count')->nullable();
            $table->unsignedBigInteger('manufacturer_id');
            $table->unsignedInteger('main_img_id');

            $table->foreign('main_img_id')
                ->references('id')
                ->on('attachments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('manufacturer_id')
                ->references('id')
                ->on('manufacturers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
