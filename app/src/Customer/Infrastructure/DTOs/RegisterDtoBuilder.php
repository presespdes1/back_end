<?php
namespace App\src\Customer\Domain\DTOs;

class RegisterDtoBuilder
{
    private $name;
    private $email;
    private $password;

    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    public function setEmail($value)
    {
        $this->email = $value;
        return $this;
    }

    public function setPassword($value)
    {
        $this->password = $value;
        return $this;
    }

    public function build()
    {
        return new RegisterDto($this->name, $this->email, $this->password);
    }


}