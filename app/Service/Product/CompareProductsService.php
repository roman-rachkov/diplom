<?php

namespace App\Service\Product;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Collection;

class CompareProductsService implements CompareProductsServiceContract
{
    private CompareProductsRepositoryContract $repository;

    private ProductDiscountServiceContract $discountService;

    public function __construct(
        CompareProductsRepositoryContract $repository,
        ProductDiscountServiceContract $discountService
    )
    {
        $this->repository = $repository;
        $this->discountService = $discountService;
    }

    public function add(Product $product, Customer $customer): bool
    {
        return $this->repository->store($product, $customer);
    }

    public function remove(Product $product, Customer $customer): bool
    {
        return $this->repository->delete($product, $customer);
    }

    public function get(Customer $customer, int $quantity = 3): Collection
    {
        if ($comparedProducts = $this->repository->getComparedProducts($customer)) {

            $comparedProducts = $comparedProducts
                ->take($quantity)
                ->sortBy([['id', 'desc']])
                ->pluck('product');

            $this->appendPriceWithDiscount($comparedProducts);

             return collect(
                 [
                     'products' =>  $comparedProducts,
                     'characteristics' => $this->getCharacteristicsValues($comparedProducts)
                 ]
             );

        } else {
            return collect();
        }
    }

    public function getCount(Customer $customer): int
    {
        return $this->repository
            ->getComparedProducts($customer)
            ->count();
    }

    protected function getCharacteristicsValues(Collection $comparedProducts): Collection
    {
        $characteristics = [];

        $characteristicsValues = $comparedProducts->pluck('characteristicValues');

        foreach ($characteristicsValues as $characteristicsValue) {
            foreach ($characteristicsValue as $characteristic) {
                if ( !array_key_exists($characteristic->name, $characteristics)) {
                    $characteristics[$characteristic->name] =
                        [
                            'measure'=> $characteristic->measure,
                            'value' => []
                        ];
                }
                $characteristics[$characteristic->name]['value'][] = $characteristic->value;
            }
        }

        return collect($characteristics);
    }

    protected function appendPriceWithDiscount(Collection $comparedProducts): Collection
    {
        $comparedProducts->transform(function ($product){
            $product->withDiscount = round(
                $product->avg_price *
                (1 -  $this->discountService->getProductDiscounts($product)),
                2
            );
            return $product;
        });

        return $comparedProducts;
    }
}
