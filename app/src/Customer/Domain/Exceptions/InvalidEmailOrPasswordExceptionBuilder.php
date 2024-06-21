<?php
namespace App\src\Customer\Domain\Exceptions;

class InvalidEmailOrPasswordExceptionBuilder
{
    private $data;

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function build()
    {
        return new InvalidEmailOrPasswordException(
            InvalidEmailOrPasswordException::INVALID_EMAIL_OR_PASSWORD_MESSAGE,
            $this->data
        );
    }
}