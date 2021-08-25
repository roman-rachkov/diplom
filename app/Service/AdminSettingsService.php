<?php

namespace App\Service;

use App\Contracts\Service\AdminSettingsServiceContract;
use Illuminate\Support\Facades\Cache;

class AdminSettingsService implements AdminSettingsServiceContract
{

    public function get(string $settingName, $default = null)
    {
        if($settingName === 'categoryCacheTime') {
            return 60*60*24;
        }
    }

    public function clearCache()
    {
        Cache::forget('categories');
    }
}