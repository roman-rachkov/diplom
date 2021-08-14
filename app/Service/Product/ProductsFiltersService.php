<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\ProductsFiltersServiceContract;

class ProductsFiltersService implements ProductsFiltersServiceContract
{

    public function filterByFeaturesList(string $featureName, array $featureList)
    {
        // TODO: Implement filterByFeaturesList() method.
    }

    public function filterByExistenceOfFeature(string $featureName)
    {
        // TODO: Implement filterByExistenceOfFeature() method.
    }

    public function filterByText(string $searchField, string $searchText)
    {
        // TODO: Implement filterByText() method.
    }
}