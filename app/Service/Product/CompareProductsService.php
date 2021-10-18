<?php

namespace App\Service\Product;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\DTO\CompareProductCharacteristicDTO;
use App\DTO\CompareProductDTO;
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

            //$this->appendPriceWithDiscount($comparedProducts);

             return collect(
                 [
                     'products' =>  $this->getCompareProductDTOs($comparedProducts),
                     'characteristics' => $this->getCharacteristicDTOs($comparedProducts)
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


    public function getCompareProductDTOs(Collection $comparedProducts): Collection
    {
        $comparedProductsDTO = [];

        foreach ($comparedProducts as $comparedProduct) {
            $discount = round(
                $comparedProduct->avg_price *
                (1 -  $this->discountService->getProductDiscounts($comparedProduct)),
                2
            );

            $comparedProductsDTO[] = CompareProductDTO::create(
                [
                    $comparedProduct,
                    $discount
                ]
            );
        }

        return collect($comparedProductsDTO);
    }

    public function getCharacteristicDTOs(Collection $comparedProducts): Collection
    {
           $characteristicsByProduct = $comparedProducts
               ->pluck('characteristicValues');

           $uniqueCharacteristics = $characteristicsByProduct
               ->flatten()
               ->unique('characteristic_id');

           $characteristicDTOs = [];

           foreach ($uniqueCharacteristics as $uniqueCharacteristic) {
               $characteristicValues = [];

               foreach ($characteristicsByProduct as $productCharacteristics) {

                   if (
                       $characteristic = $productCharacteristics
                           ->firstWhere(
                               'characteristic_id',
                               $uniqueCharacteristic->characteristic_id
                           )
                   ) {
                       $characteristicValues[] = $characteristic->value;
                    } else {
                       $characteristicValues[] = '-';
                   }
               }
               $characteristicDTOs[] = CompareProductCharacteristicDTO::create(
                   [
                       $uniqueCharacteristic->name,
                       $uniqueCharacteristic->measure,
                       count(array_unique($characteristicValues)) === 1,
                       $characteristicValues
                   ]
               );
           }

           return collect($characteristicDTOs);
    }
}
