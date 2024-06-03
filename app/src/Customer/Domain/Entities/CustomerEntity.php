<?php 
namespace App\src\Customer\Domain\Entities;

class CustomerEntity
{
    private $id;
    private $name;
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
}
