<?php

namespace App\Service\Imports;

use App\Contracts\Repository\ImportProductsRepositoryContract;
use App\Contracts\Service\Imports\DataReaderContract;
use App\Contracts\Service\Imports\ProductsImportServiceContract;
use Illuminate\Support\Collection;

class ProductsImportService implements ProductsImportServiceContract
{

    public function __construct(private ImportProductsRepositoryContract $repositoryContract)
    {
    }

    public function import(DataReaderContract $contract): Collection
    {
        return $this->repositoryContract->saveProducts($contract->getData());
    }
}