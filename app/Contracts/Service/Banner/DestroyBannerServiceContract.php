<?php

namespace App\Contracts\Service\Banner;

interface DestroyBannerServiceContract
{
    public function destroy(string $id);
}