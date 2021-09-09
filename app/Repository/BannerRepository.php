<?php

namespace App\Repository;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Repository\BannerRepositoryContract;
use App\Models\Banner;
use App\Service\AdminSettingsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class BannerRepository implements BannerRepositoryContract
{
    private $adminsSettings;

    public function __construct(AdminSettingsRepositoryContract $adminsSettings)
    {
        $this->adminsSettings = $adminsSettings;
    }

    public function getBanners(): Collection
    {
        $ttl = $this->adminsSettings->get('bannerCacheTime', 600);

        return Cache::tags(['banners'])->remember('categories',$ttl,function () {
            return Banner::where('is_active', 1)->inRandomOrder()->limit(3)->get();
        });
    }

}
