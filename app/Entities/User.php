<?php

namespace App\Entities;

class User
{
    private ?string $id;
    private string $username;
    private string $email;
    private string $password;

    /**
     * this method use for creating object user from array at model
     *
     * @param array $raw
     * @return User
     */
    public static function rawToObject(array $raw): User
    {
        $user = new User();
        $user->setUsername($raw["username"]);
        $user->setEmail($raw["email"]);
        $user->setPassword($raw["password"]);
        $user->setId($raw["id"]);

        return $user;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}