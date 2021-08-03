<?php

namespace App\Contracts;

interface AdminSettingsServiceContract
{
    public function get(string $settingName,  $default = null);
}