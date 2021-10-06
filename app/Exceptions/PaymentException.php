<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class PaymentException extends ModelNotFoundException
{
    public function __construct($message = "", $code = 800, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
