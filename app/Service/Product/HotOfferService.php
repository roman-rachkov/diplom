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

    public function get()
    {
        $countHotOffers = $this->settings->get('count_hot_offers', 9);
        $hotOffers = [];
        while (count($hotOffers) < $countHotOffers) {
            $product = $this->discountGroup->getRandomDiscountGroup()->products()->inRandomOrder()->first();
            $discount = $this->discountsService->getProductDiscounts($product);
            if ($discount) {
                $hotOffers[] = [
                    'product' => $product,
                    'discount' => $discount,
                ];
            }
        }

        return $hotOffers;
    }
}
