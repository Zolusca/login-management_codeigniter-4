<?php

namespace App\Service;

use App\Entities\User;
use App\Exception\AlreadyRegistered;
use App\Exception\BadCredential;
use App\Exception\DataNotFound;
use App\Helpers\PasswordEncoder;
use App\Helpers\UuidGenerator;
use App\Models\UserModel;
use http\Exception\RuntimeException;

class UserService
{
    private UserModel $userModel;

    /**
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
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

            log_message('info',"success create new user {$user->getEmail()}");

        } catch (\ReflectionException $e) {
            // next we will use monolog
            log_message('error',$e->getMessage());

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

        log_message("info","user {$user->getEmail()} success login");
    }
}