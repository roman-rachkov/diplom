<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\Contracts\Service\Imports\DataReaderFactoryServiceContract;
use Symfony\Component\HttpFoundation\File\File;

class DataReaderFactoryService implements DataReaderFactoryServiceContract
{

    public function getReaderByFile(File $file): DataReaderContract
    {
        // TODO: Implement getReaderByData() method.
    }
}