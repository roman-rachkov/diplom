<?php

namespace App\Repository;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Product;

class DiscountRepository implements DiscountRepositoryContract
{
    private AdminSettingsServiceContract $adminSettings;

    public function __construct(AdminSettingsServiceContract $adminSettings)
    {
        $this->adminSettings= $adminSettings;
    }

    public function getAllProductDiscounts(Product $product)
    {
        $ttl = $this->adminSettings->get('discountsCacheTime', 60 * 60 * 24);

        //Получить все скидки по товару

        Product::with(['discountGroups' => function ($query) {$query->join('discounts', 'discount_id', 'discounts.id');}])->find(143);


    }

}