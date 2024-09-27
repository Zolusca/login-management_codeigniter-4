<?php

namespace App\Libraries;

use App\Entities\User;
use App\Exception\InvalidJwtCookie;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use mysql_xdevapi\SqlStatementResult;

class JwtCookie
{
    private string $KEY ;

    public function __construct()
    {
        $this->KEY = getenv('encryption.key');
    }

    public function createJwtCookie(User $user)
    {
        $payload =
            [
                "username"=>$user->getUsername(),
                "email"=>$user->getEmail()
            ];

        $data = JWT::encode($payload,$this->KEY,'HS256');

        return $data;
    }

    /**
     * example access data :
     * $data->username
     * $data->email
     * $data->{payload data}
     *
     * @param string $payload
     * @return \stdClass|void
     */
    public function validateJwt(string $payload)
    {
        try {
            $decoded = JWT::decode($payload, new Key($this->KEY, 'HS256'));

            return $decoded;

        }catch (\Exception $exception){
            throw new InvalidJwtCookie($exception);
        }

    }
}