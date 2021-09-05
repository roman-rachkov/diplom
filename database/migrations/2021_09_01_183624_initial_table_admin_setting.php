<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialTableAdminSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = config('options');

        foreach ($categories as $category => $options) {
            foreach ($options as $option) {
                \App\Models\AdminSetting::create([
                    'name' => $option['name'],
                    'value' => $option['value'],
                    'category' => $category,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('admin_settings')->delete();
    }
}
