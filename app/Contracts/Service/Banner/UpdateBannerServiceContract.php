<?php

namespace App\Contracts\Service\Banner;

interface UpdateBannerServiceContract
{
    public function update(array $attributes, string $id);
}