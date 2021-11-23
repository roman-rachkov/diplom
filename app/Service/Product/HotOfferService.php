<?php

namespace App\Service\Product;

use App\Contracts\Repository\DiscountGroupRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Product\HotOfferServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;

class HotOfferService implements HotOfferServiceContract
{
    private DiscountGroupRepositoryContract $discountGroup;
    private AdminSettingsServiceContract $settings;
    private ProductDiscountServiceContract $discountsService;

    public function __construct(
        DiscountGroupRepositoryContract $discountGroup,
        AdminSettingsServiceContract $settings,
        ProductDiscountServiceContract $discountsService
    )
    {
        $this->discountGroup = $discountGroup;
        $this->settings = $settings;
        $this->discountsService = $discountsService;
    }

    public function get(): array
    {
        $countHotOffers = $this->settings->get('count_hot_offers', 8);
        $hotOffers = [];

        if (!$this->discountGroup->hasProducts()) {
            return $hotOffers;
        }

        while (count($hotOffers) < $countHotOffers) {
            $product = $this
                ->discountGroup
                ->getRandomDiscountGroup()
                ->products
                ->random();

            $discount = $this
                ->discountsService
                ->getProductPriceWithDiscount($product);

            if ($discount) {
                $hotOffers[] = [
                    'product' => $product->load(['prices', 'category', 'image']),
                    'discount' => $discount,
                ];
            }
        }

        return $hotOffers;
    }
}
