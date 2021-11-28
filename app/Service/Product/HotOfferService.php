<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\HotOfferServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Repository\ProductRepository;
use Illuminate\Support\Collection;

class HotOfferService implements HotOfferServiceContract
{
    private ProductDiscountServiceContract $discountsService;
    private ProductRepository $productRepository;

    public function __construct(
        ProductDiscountServiceContract $discountsService,
        ProductRepository $productRepository,
    )
    {
        $this->discountsService = $discountsService;
        $this->productRepository = $productRepository;
    }

    public function get(): Collection
    {
        $hotOffers = collect();

        $products = $this->productRepository->getHotDiscountsProducts();

        foreach ($products as $product) {
            $discount = $this
                ->discountsService
                ->getProductDiscounts($product);

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
