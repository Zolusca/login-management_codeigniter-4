<?php

namespace App\Helpers;

use Ramsey\Uuid\Uuid;

class UuidGenerator
{
    /**
     * generating unique string with default length 16
     *
     * @param int $length
     * @return string
     */
    public static function generateUuid(int $length=16): string
    {
        $uuid = Uuid::uuid4()->toString();
        return substr($uuid,0,$length);
    }
}