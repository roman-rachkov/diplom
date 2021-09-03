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
        $optionValue = cache()->tags($variable)->remember($variable, 600, function () use ($variable, $default) {

            $this->model->setCacheTag($variable);

            return $this->model->where('variable', $variable)->first()->value ?? $default;
        });

        return $optionValue;
    }
}
