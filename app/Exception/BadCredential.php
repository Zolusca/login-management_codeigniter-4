<?php

namespace App\Exception;

use JetBrains\PhpStorm\Pure;

class BadCredential extends \Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}