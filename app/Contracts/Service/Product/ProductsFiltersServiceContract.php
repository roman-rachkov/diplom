<?php

namespace App\Contracts\Service\Product;

interface ProductsFiltersServiceContract
{
    public function filterByFeaturesList(string $featureName, array $featureList);

    public function filterByExistenceOfFeature(string $featureName);

    public function filterByText(string $searchField, string $searchText);
}