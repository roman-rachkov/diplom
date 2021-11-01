<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 6, 2)->default(0);
            $table->enum('method_type', \App\Models\Discount::getMethodTypes()->toArray())->default(\App\Models\Discount::METHOD_CLASSIC);
            $table->enum('category_type', \App\Models\Discount::getCategoryTypes()->toArray())->default(\App\Models\Discount::CATEGORY_PRODUCTS);
            $table->integer('weight')->default(0);
            $table->integer('minimum_qty')->default(0);
            $table->integer('maximum_qty')->default(0);
            $table->decimal('minimal_cost')->default(0);
            $table->decimal('maximum_cost')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
