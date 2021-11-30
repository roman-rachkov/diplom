<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use LireinCore\YMLParser\YML;
use Symfony\Component\HttpFoundation\File\File;

class YmlDataReaderService implements DataReaderContract
{

    public function __construct(private File $file)
    {}

    public function getData(): Collection
    {
        $yml = simplexml_load_file($this->file->getRealPath());



    }
}