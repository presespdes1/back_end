<?php
namespace App\src\Customer\Domain\DTOs;

class RegisterDto
{
    private $name;
    private $email;
    private $password;
    private $passwordConfirmation;

    public function __construct($name, $email, $password, $passwordConfirmation)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPasswordConfirmation()
    {
        return $this->passwordConfirmation;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->passwordConfirmation
        ];
    }
}