<?php

namespace App\Repository;

use App\Contracts\Repository\CategoryRepositoryContract;
use App\Models\Category;
use App\Service\AdminSettingsService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryContract
{
    private $adminsSettings;

    public function __construct(AdminSettingsService $adminsSettings)
    {
        $this->adminsSettings = $adminsSettings;
    }

    public function getCategories(): Collection
    {
        $ttl = $this->adminsSettings->get('categoryCacheTime');

        return Cache::remember('categories',$ttl,function () {

            return Category::where('is_active', 1)->get()->toTree()->sortBy('sort_index');

        });
    }
}