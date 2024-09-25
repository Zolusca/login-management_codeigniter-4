<?php

namespace App\Models;

use App\Entities\User;
use App\Exception\DataNotFound;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
        [
            "id","email","password","username"
        ];

    /**
     * @throws \ReflectionException
     */
    public function createUser(User $user): void
    {
        $this->insert($this->objectToRaw($user));
    }

    /**
     * @throws \ReflectionException
     */
    public function updateUserData(User $user)
    {
        $this->where("id",$user->getId())
            ->set($this->objectToRaw($user,true))->update();
    }

    /**
     * @throws DataNotFound
     */
    public function getUserByEmail(string $email)
    {
        $result = $this->where('email',$email)
            ->first();

        $this->isResultEmpty($result);

        return User::rawToObject($result);
    }

    public function isEmailAlreadyUsed(string $email)
    {

        $result = $this->where('email',$email)
            ->first();

        if($result){
            return  true;
        }
        return false;
    }

    /**
     * @throws DataNotFound
     */
    public function getUserById(string $id)
    {
        $result = $this->where('id',$id)
            ->first();

        $this->isResultEmpty($result);

        return User::rawToObject($result);
    }

    /**
     * @throws \ReflectionException
     */
    public function updatePassword(User $user)
    {
        $this->where('id',$user->getId())
            ->set(["password"=>$user->getPassword()])->update();
    }

    /**
     * @throws DataNotFound
     */
    private function isResultEmpty($result): void
    {
        if(empty($result)){
            throw new DataNotFound("data user not found");
        }
    }

    private function objectToRaw(User $user,bool $forUpdate=false)
    {
        if ($forUpdate){
            return
                [
                  "username"=>$user->getUsername(),
                  "email"=>$user->getEmail()
                ];
        }

        return
            [
                "id"=>$user->getId(),
                "password"=>$user->getPassword(),
                "email"=>$user->getEmail(),
                "username"=>$user->getUsername()
            ];
    }
}
