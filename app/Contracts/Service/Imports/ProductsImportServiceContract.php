<?php

namespace App\Contracts\Service\Imports;

use Illuminate\Support\Collection;

interface ProductsImportServiceContract
{
    public function import(Collection $data): bool;
}