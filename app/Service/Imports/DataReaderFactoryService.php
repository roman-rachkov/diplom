<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\Contracts\Service\Imports\DataReaderFactoryServiceContract;
use Illuminate\Http\UploadedFile;

class DataReaderFactoryService implements DataReaderFactoryServiceContract
{

    public function getReaderByFile(UploadedFile $file): DataReaderContract
    {
        // TODO: Implement getReaderByData() method.
    }
}