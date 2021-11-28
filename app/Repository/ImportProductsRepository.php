<?php

namespace App\Repository;

use App\Contracts\Repository\ImportProductsRepositoryContract;
use App\DTO\ProductImportDTO;
use App\Models\Product;
use Illuminate\Support\Collection;

class ImportProductsRepository implements ImportProductsRepositoryContract
{

    public function saveProduct(ProductImportDTO $product): bool|Product
    {
        // TODO: Implement saveProduct() method.
    }

    public function saveProducts(Collection $products): bool|Collection
    {
        // TODO: Implement saveProducts() method.
    }
}