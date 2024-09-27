<?php

namespace App\Service;

use App\Entities\User;
use App\Exception\AlreadyRegistered;
use App\Exception\BadCredential;
use App\Exception\DataNotFound;
use App\Helpers\PasswordEncoder;
use App\Helpers\UuidGenerator;
use App\Libraries\LoggerConfiguration;
use App\Models\UserModel;
use Monolog\Logger;
use RuntimeException;

class UserService
{
    private UserModel $userModel;
    private Logger $appLogger;
    /**
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        $this->appLogger = LoggerConfiguration::LoggerCreations();
        $this->userModel = $userModel;
    }

    public function createNewUser(User $user)
    {
        try {

               $status =  $this->userModel->isEmailAlreadyUsed($user->getEmail());

               // i dont recommend for this method send message 'email already used'
                // but this video only for learning educate
               if($status){
                   throw new AlreadyRegistered("email already used");
               }

               $id = UuidGenerator::generateUuid(20);
               $passwordEncrypt = PasswordEncoder::encryptPassword($user->getPassword());

               $user->setId($id);
               $user->setPassword($passwordEncrypt);

                $this->userModel->createUser($user);

                $this->appLogger->info("success create new user ",["email"=>$user->getEmail()]);

        } catch (\ReflectionException $e) {

            $this->appLogger->error(
                "error when create user",
                ["messsage-err"=>$e->getMessage(),"email"=>$user->getEmail()]);

            throw new RuntimeException("Oops error server");
        }

    }

    /**
     * @param User $user {email and password required}
     * @return void
     * @throws DataNotFound user not registered
     * @throws BadCredential
     */
    public function login(User $user)
    {
        $tempUser = $this->userModel->getUserByEmail($user->getEmail());

        // verify the password
        if(!password_verify($user->getPassword(),$tempUser->getPassword())){
            throw new BadCredential("email or password incorrect");
        }

        $this->appLogger->info("successful user login",["email"=>$user->getEmail()]);
    }

    /**
     * @throws DataNotFound
     */
    public function getUserByEmail(string $email)
    {
        return $this->userModel->getUserByEmail($email);
    }
}