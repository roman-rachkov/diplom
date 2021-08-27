<?php

namespace App\Contracts\Repository;

use Illuminate\Database\Eloquent\Collection;

interface BannerRepositoryContract
{
    public function getBanners(): Collection;
}
