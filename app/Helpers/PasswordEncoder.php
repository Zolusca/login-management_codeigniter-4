<?php

namespace App\Helpers;

class PasswordEncoder
{
    public static function encryptPassword(string $password)
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }
}