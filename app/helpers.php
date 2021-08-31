<?php

function initialConfigurationFilling() {
    $adminSettingCount = \App\Models\AdminSetting::count();

    if ($adminSettingCount > 0) {
        return;
    }

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

function resetConfiguration() {
    \Illuminate\Support\Facades\DB::table('admin_settings')->delete();
}
