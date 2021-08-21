<?php

namespace App\Contracts\Service;

interface AdminSettingsServiceContract
{
    public function get(string $settingName,  $default = null);
}