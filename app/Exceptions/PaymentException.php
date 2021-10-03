<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class PaymentException extends Exception
{
    public function __construct($message = "", $code = 800, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
