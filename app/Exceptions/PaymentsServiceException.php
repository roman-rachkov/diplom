<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class PaymentsServiceException extends ModelNotFoundException
{
    public function __construct($message = "", $code = 801, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
