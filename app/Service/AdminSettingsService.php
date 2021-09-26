<?php

namespace App\Service;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;

class AdminSettingsService implements AdminSettingsServiceContract
{
    private AdminSettingsRepositoryContract $adminSettingsRepository;

    public function __construct(AdminSettingsRepositoryContract $adminSettingsRepository)
    {
        $this->adminSettingsRepository = $adminSettingsRepository;
    }

    public function get(string $settingName, $default = null)
    {
        $value = $this->adminSettingsRepository->get($settingName);

        return $value ?? $default;
    }
}
