<?php

namespace App\Controllers\AuthController;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Exception\BadCredential;
use App\Exception\DataNotFound;
use App\Service\UserService;
use Config\Services;

class LoginAuth extends BaseController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = Services::userService();
    }

    public function loginForm()
    {
        return view("login");
    }

    public function login()
    {
        $email    = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);

        try {
            $this->userService->login($user);

            return  view("dashboard");

        } catch (BadCredential|DataNotFound $e) {
            return redirect()->to(base_url("login"))->with("error",$e->getMessage());
        }
    }
}