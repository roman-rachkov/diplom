<?php

namespace App\Contracts\Repository;

interface AdminSettingsRepositoryContract
{
    public function get(string $variable);
}
