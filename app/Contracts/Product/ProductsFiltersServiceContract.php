<?php

namespace App\Contracts\Product;

use Illuminate\Support\Collection;

interface ProductsFiltersServiceContract
{
    public function filterByFeaturesList(Collection $products, string $featureName, array $featureList);

    public function filterByExistenceOfFeature(Collection $products, string $featureName);

    public function filterByText(Collection $products, string $searchField, string $searchText);
}