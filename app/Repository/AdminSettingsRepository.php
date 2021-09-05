<?php

namespace App\Repository;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Models\AdminSetting;

class AdminSettingsRepository implements AdminSettingsRepositoryContract
{
    protected $model;
    public function __construct(AdminSetting $adminSetting)
    {
        $this->model = $adminSetting;
    }

    public function get(string $variable, $default=null)
    {
        $optionValue = cache()->tags(['admin_settings', $variable])->remember($variable, 600, function () use ($variable) {

            $variable = $this->model->where('variable', $variable)->first();

            return isset($variable) ? $variable->value : null;
        });

        return $optionValue ?? $default;
    }
}
