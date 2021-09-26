<?php

namespace App\Repository;

use App\Contracts\Repository\CategoryRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings)
    {
        $this->adminSettings = $adminSettings;
    }

    public function getCategories(): Collection
    {
        $ttl = $this->adminSettings->get('categoryCacheTime', 60*60*24);

        return Cache::tags(['categories'])->remember('all',$ttl,function () {

            return Category::where('is_active', 1)->get()->toTree()->sortBy('sort_index');

        });
    }
}
