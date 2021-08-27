<?php

namespace App\Repository;

use App\Contracts\Repository\BannerRepositoryContract;
use App\Models\Banner;
use App\Service\AdminSettingsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class BannerRepository implements BannerRepositoryContract
{
    private $adminsSettings;

    /**
     * @param AdminSettingsService $adminsSettings
     */
    public function __construct(AdminSettingsService $adminsSettings)
    {
        $this->adminsSettings = $adminsSettings;
    }

    public function getBanners(): Collection
    {
        $ttl = $this->adminsSettings->get('bannerCacheTime') ?? 600;

        return Cache::remember('categories',$ttl,function () {
            return Banner::where('is_active', 1)->inRandomOrder()->limit(3)->get();
        });
    }

}
