<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;

class DataReaderFactoryService implements \App\Contracts\Service\Imports\DataReaderFactoryServiceContract
{

    public function getReaderByData(mixed $data): DataReaderContract
    {
        // TODO: Implement getReaderByData() method.
    }
}