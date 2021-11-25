<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\Contracts\Service\Imports\DataReaderFactoryServiceContract;

class DataReaderFactoryService implements DataReaderFactoryServiceContract
{

    public function getReaderByData(mixed $file): DataReaderContract
    {
        // TODO: Implement getReaderByData() method.
    }
}