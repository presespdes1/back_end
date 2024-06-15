<?php
namespace App\src\Customer\Domain\DTOs;

class LoginDto
{
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function toArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}