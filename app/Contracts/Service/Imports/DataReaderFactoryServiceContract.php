<?php

namespace App\Contracts\Service\Imports;

interface DataReaderFactoryServiceContract
{
    public function getReaderByData(mixed $data): DataReaderContract;
}