<?php 
namespace App\src\Customer\Domain\Entities;

class CustomerEntity
{
    private $id;
    private $name;
    private $role;
    private $token;
    private $email;
    private $emailVerifiedAt;
    private $password;
    private $rememberToken;
    private $createdAt;
    private $updatedAt;

    public function __construct
    (
        $id,
        $name,
        $role,
        $token,
        $email,
        $emailVerifiedAt,
        $password,
        $rememberToken,
        $createdAt,
        $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->role = $role;
        $this->token = $token;
        $this->email = $email;
        $this->emailVerifiedAt = $emailVerifiedAt;
        $this->password = $password;
        $this->rememberToken = $rememberToken;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getRole(){
        return $this->role;
    }

    public function getToken(){
        return $this->token;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getEmailVerifiedAt(){
        return $this->emailVerifiedAt;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getRememberToken(){
        return $this->rememberToken;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function getUpdatedAt(){
        return $this->updatedAt;
    }

    public function toArrayResponse()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'role' => $this->getRole(),
            'token' => $this->getToken()
        ];
    }
}
