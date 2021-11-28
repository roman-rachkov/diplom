<?php

namespace App\Contracts\Repository;

use App\DTO\ProductImportDTO;
use App\Models\Product;
use Illuminate\Support\Collection;

interface ImportProductsRepositoryContract
{
    public function saveProduct(ProductImportDTO $product): bool|Product;

    public function saveProducts(Collection $products): bool|Collection;

}