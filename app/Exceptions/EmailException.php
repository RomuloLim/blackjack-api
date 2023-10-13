<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class EmailException extends Exception
{
    public static function InvalidVerificationUrl(): self
    {
        return new self(
            'The provided verification URL is invalid.',
            Response::HTTP_FORBIDDEN
        );
    }
}
