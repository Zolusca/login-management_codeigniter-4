<?php

namespace App\Exception;

class InvalidJwtCookie extends \RuntimeException
{
    public function __construct(\Throwable $throwable)
    {
        parent::__construct($throwable->getMessage());
    }
}