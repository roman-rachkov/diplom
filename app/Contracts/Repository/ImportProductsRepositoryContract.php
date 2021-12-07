<?php

namespace App\Contracts\Repository;

use App\DTO\ProductImportDTO;
use App\Models\Product;
use Illuminate\Support\Collection;

interface ImportProductsRepositoryContract
{
    public function saveProduct(ProductImportDTO $product): Product;

    public function saveProducts(Collection $productsDTO): Collection;

}