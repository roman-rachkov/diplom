<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\Contracts\Service\Imports\DataReaderFactoryServiceContract;
use App\Exceptions\DataReaderNotFoundException;
use Symfony\Component\HttpFoundation\File\File;

class DataReaderFactoryService implements DataReaderFactoryServiceContract
{
    protected $readers = [
        'json' => JsonDataReaderService::class,
        'xml' => YmlDataReaderServcie::class,
    ];

    public function getReaderByFile(File $file): DataReaderContract
    {
        foreach ($this->readers as $key => $value) {
            if (str_contains($file->getMimeType(), $key)) {
                return new $value($file);
            }
        }
        throw new DataReaderNotFoundException($file->getMimeType());
    }
}