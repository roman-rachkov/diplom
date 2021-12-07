<?php

namespace App\Contracts\Service\Imports;

use Illuminate\Support\Collection;

interface DataReaderContract
{
    public function getData(): Collection;

    public function getErrorsLog(): array;
}