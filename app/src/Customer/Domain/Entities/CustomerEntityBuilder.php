<?php
namespace App\src\Customer\Domain\Entities;

class CustomerEntityBuilder
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

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function setRole($role){
        $this->role = $role;
        return $this;
    }

    public function setToken($token){
        $this->token = $token;
        return $this;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function setEmailVerifiedAt($emailVerifiedAt){
        $this->emailVerifiedAt = $emailVerifiedAt;
        return $this;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function setRememberToken($rememberToken){
        $this->rememberToken = $rememberToken;
        return $this;
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdatedAt($updatedAt){
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function build(){
        return new CustomerEntity
        (
            $this->id,
            $this->name,
            $this->role,
            $this->token,
            $this->email,
            $this->emailVerifiedAt,
            $this->password,
            $this->rememberToken,
            $this->createdAt,
            $this->updatedAt
        );
    }

}