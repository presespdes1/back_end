<?php
namespace App\src\Customer\Domain\DTOs;

class LoginDtoBuilder
{
    private $email;
    private $password;

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function build()
    {
        return new LoginDto($this->email, $this->password);
    }

}