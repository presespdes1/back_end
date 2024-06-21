<?php
namespace App\src\Customer\Domain\Exceptions;

use App\src\Exception\Domain\Entities\BaseException;

class InvalidLoginArgumentException extends BaseException
{
    const INVALID_LOGIN_DATA_MESSAGE = "Datos de inicio de sesion invalidos";
    
    public function __construct($message = self::INVALID_LOGIN_DATA_MESSAGE, $data)
    {
        parent::__construct($message, $data);        
    }

    public function getData()
    {
        return parent::getData();
    }
}