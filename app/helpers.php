<?php

function initialConfigurationFilling() {
    $adminSettingCount = \App\Models\AdminSetting::count();

    if ($adminSettingCount > 0) {
        return;
    }

    $options = config('options');

    foreach ($options as $option) {
        \App\Models\AdminSetting::create([
            'name' => $option['name'],
            'value' => $option['value'],
        ]);
    }
}

function resetConfiguration() {
    \App\Models\AdminSetting::delete();
}
