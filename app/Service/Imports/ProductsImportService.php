<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\ProductsImportServiceContract;
use Illuminate\Support\Collection;

class ProductsImportService implements ProductsImportServiceContract
{
    public function import(Collection $data): bool
    {
        // TODO: Implement import() method.
    }
}