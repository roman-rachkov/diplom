<?php

namespace App\Exceptions;

use Prophecy\Exception\Doubler\ClassNotFoundException;

class DataReaderNotFoundException extends ClassNotFoundException
{
    public function __construct(string $mimeType)
    {
        parent::__construct('DataReader not found for ' . $mimeType . ' type', $classname = 'Anonymous');
    }
}
