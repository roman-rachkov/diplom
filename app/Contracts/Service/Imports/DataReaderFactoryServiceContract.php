<?php

namespace App\Contracts\Service\Imports;

use Symfony\Component\HttpFoundation\File\File;

interface DataReaderFactoryServiceContract
{
    public function getReaderByFile(File $file): DataReaderContract;
}