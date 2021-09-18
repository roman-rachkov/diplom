<?php

namespace App\Service;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;

class AdminSettingsService implements AdminSettingsServiceContract
{
    private $adminSettingsRepository;

    public function __construct(AdminSettingsRepositoryContract $adminSettingsRepository)
    {
        $this->adminSettingsRepository = $adminSettingsRepository;
    }

    public function get(string $settingName, $default = null)
    {
        if ($default) return $default;

        return $this->adminSettingsRepository->get($settingName);
    }
}
