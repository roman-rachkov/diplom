<?php

namespace App\Repository;

use App\Contracts\Repository\PriceRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PriceRepository implements PriceRepositoryContract
{
    public function __construct(
        private Price $model,
        private AdminSettingsServiceContract $adminSettingsService
    )
    {}

    public function getAllPrices(): Collection
    {
        return $this->model->all();
    }

    public function getMaxPrice(): float
    {
        return Cache::tags(
            [
                'prices',
                'products',
                'sellers'
            ])
            ->remember('max_price', $this->getTtl(), function ()  {

                return Price::max('price');

            });
    }

    public function getMinPrice(): float
    {
        return Cache::tags(
            [
                'prices',
                'products',
                'sellers'
            ])
            ->remember('min_price', $this->getTtl(), function ()  {

                return Price::min('price');

            });
    }

    public function getMaxPriceForCategory(Collection $arr): float
    {
        return Cache::tags(
            [
                'prices',
                'products',
                'sellers'
            ])
            ->remember(
                'max_price|categories=' . $arr->sort()->implode(','),
                $this->getTtl(),
                function () use ($arr)  {

                return $this->model->whereIn('product_id', $arr)->max('price');
            });
    }

    public function getMinPriceForCategory(Collection $arr): float
    {
        return Cache::tags(
            [
                'prices',
                'products',
                'sellers'
            ])
            ->remember(
                'min_price|categories=' . $arr->sort()->implode(','),
                $this->getTtl(),
                function () use ($arr)  {

                    return $this->model->whereIn('product_id', $arr)->min('price');
                });
    }

    public function getSellerProductPrice(Seller $seller, Product $product): float
    {
        return Cache::tags(
            [
                'prices',
                'products',
                'sellers'
            ])
            ->remember(
                'price|seller_id=' . $seller->id . '|product_id=' . $product->id,
                $this->getTtl(),
                function () use ($seller, $product)  {

                return $this->model->where(
                    [
                        'seller_id' => $seller->id,
                        'product_id' => $product->id
                    ])
                    ->get()
                    ->first()
                    ->price;

            });
    }

    protected function getTtl()
    {
        return $this->adminSettingsService->get('pricesCacheTime', 60 * 60 * 24);
    }
}
