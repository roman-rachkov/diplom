<?php

namespace App\Service\Product;

use App\Contracts\Repository\DiscountGroupRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Product\HotOfferServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Repository\ProductRepository;
use Illuminate\Support\Collection;

class HotOfferService implements HotOfferServiceContract
{
    private DiscountGroupRepositoryContract $discountGroup;
    private AdminSettingsServiceContract $settings;
    private ProductDiscountServiceContract $discountsService;
    private ProductRepository $productRepository;

    public function __construct(
        DiscountGroupRepositoryContract $discountGroup,
        AdminSettingsServiceContract $settings,
        ProductDiscountServiceContract $discountsService,
        ProductRepository $productRepository,
    )
    {
        $this->discountGroup = $discountGroup;
        $this->settings = $settings;
        $this->discountsService = $discountsService;
        $this->productRepository = $productRepository;
    }

    public function get(): Collection
    {
        $countHotOffers = $this->settings->get('count_hot_offers', 8);
        $hotOffers = collect();

        // Эта проверка нужна когда DiscountGroup ещё не заведены
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
                $hotOffers->push([
                    'product' => $product->load(['prices', 'category', 'image']),
                    'discount' => $discount,
                ]);
            }
        }

        return $hotOffers;
    }
}
