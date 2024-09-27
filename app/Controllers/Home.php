<?php

namespace App\Controllers;

use App\Entities\User;
use App\Exception\AlreadyRegistered;
use App\Helpers\PasswordEncoder;
use App\Helpers\UuidGenerator;
use App\Libraries\JwtCookie;
use App\Libraries\LoggerConfiguration;
use App\Service\UserService;
use Config\Services;
use Monolog\Logger;
use function Symfony\Component\String\u;

class Home extends BaseController
{
    private UserService $userService;
    private Logger $appLogger;

    public function __construct()
    {
        $this->appLogger   = LoggerConfiguration::LoggerCreations();
        $this->userService = Services::userService();
    }

    public function index():string
    {
        return view("register");
    }

    public function register()
    {
        $email    = $this->request->getVar("email");
        $password = $this->request->getVar("password");
        $username = $this->request->getVar("username");

        $user = new User();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setPassword($password);

        try {

            $this->userService->createNewUser($user);

            return redirect()->to(base_url("login"))->with("message","success create new account");

        }catch (AlreadyRegistered $exception){
            return redirect()->to(base_url())->with("message",$exception->getMessage());
        }
    }
}