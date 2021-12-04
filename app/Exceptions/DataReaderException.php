<?php

namespace App\Exceptions;

use Throwable;

class DataReaderException extends \Exception
{
    public function __construct($message = "", $code = 900, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}