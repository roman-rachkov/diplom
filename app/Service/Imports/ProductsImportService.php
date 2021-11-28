<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\Contracts\Service\Imports\ProductsImportServiceContract;
use Illuminate\Support\Collection;

class ProductsImportService implements ProductsImportServiceContract
{
    public function import(DataReaderContract $contract): Collection
    {
        // TODO: Implement import() method.
    }
}