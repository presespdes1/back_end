<?php
namespace App\src\Customer\Domain\Exceptions;

use InvalidArgumentException;

class InvalidRegisterArgumentException extends InvalidArgumentException
{
    const INVALID_REGISTER_DATA_MESSAGE = "Datos no validos";
    private $data;

    public function __construct($message = self::INVALID_REGISTER_DATA_MESSAGE, $data = null)
    {
        parent::__construct($message);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
