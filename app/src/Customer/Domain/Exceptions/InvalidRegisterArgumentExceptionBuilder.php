<?php
namespace App\src\Customer\Domain\Exceptions;

class InvalidRegisterArgumentExceptionBuilder
{
    private $data;

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function build()
    {
        return new InvalidRegisterArgumentException(
            InvalidRegisterArgumentException::INVALID_REGISTER_DATA_MESSAGE, 
            $this->data
        );
    }
}