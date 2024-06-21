<?php
namespace App\src\Customer\Domain\Exceptions;

class InvalidLoginArgumentExceptionBuilder
{
    private $data;

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function build()
    {
        return new InvalidLoginArgumentException(
            InvalidLoginArgumentException::INVALID_LOGIN_DATA_MESSAGE,
            $this->data
        );
    }
}