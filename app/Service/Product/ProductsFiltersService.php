<?php

namespace App\Service\Product;

use Illuminate\Support\Collection;

class ProductsFiltersService implements \App\Contracts\ProductsFiltersServiceContract
{

    public function filterByFeaturesList(Collection $products, string $featureName, array $featureList)
    {
        // TODO: Implement filterByFeaturesList() method.
    }

    public function filterByExistenceOfFeature(Collection $products, string $featureName)
    {
        // TODO: Implement filterByExistenceOfFeature() method.
    }

    public function filterByText(Collection $products, string $searchField, string $searchText)
    {
        // TODO: Implement filterByText() method.
    }
}