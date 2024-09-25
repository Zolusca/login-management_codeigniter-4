<?php

namespace App\Exception;

class AlreadyRegistered extends \RuntimeException
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}