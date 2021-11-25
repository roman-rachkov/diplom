<?php

namespace App\Contracts\Service\Imports;

use Illuminate\Http\UploadedFile;

interface DataReaderFactoryServiceContract
{
    public function getReaderByFile(UploadedFile $file): DataReaderContract;
}