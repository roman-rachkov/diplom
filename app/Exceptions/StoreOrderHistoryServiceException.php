<?php

namespace App\Exceptions;

use Doctrine\DBAL\Exception;
use Throwable;

class StoreOrderHistoryServiceException extends Exception
{
    public function __construct($message = "", $code = 990, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}