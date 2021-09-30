<?php

namespace App\Repository;

use App\Contracts\Repository\CategoryRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Kalnoy\Nestedset\Collection as NestedsetCollection;

class CategoryRepository implements CategoryRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings)
    {
        $this->adminSettings = $adminSettings;
    }

    public function getCategories(): Collection
    {
        return Cache::tags(['categories'])->remember(
            'all',
            $this->getTtl(),
            function () {
                return Category::where('is_active', 1)->get()->toTree()->sortBy('sort_index');
            });
    }

    public function getAncestors(Category $category): NestedsetCollection
    {
        return Cache::tags(['categories'])->remember(
            'ancestors_id=' . $category->id,
            $this->getTtl(),
            function () use ($category) {
                return $category->ancestors;
            });
    }

    protected function getTtl()
    {
        return $this->adminSettings
            ->get('categoryCacheTime', 60 * 60 * 24);
    }
}
