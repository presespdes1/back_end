<?php
namespace App\src\Customer\Domain\Exceptions;

use App\src\Exception\Domain\Entities\BaseException;

class InvalidEmailOrPasswordException extends BaseException
{
    const INVALID_EMAIL_OR_PASSWORD_MESSAGE = "Email o password incorrectos";

    public function __construct($message = self::INVALID_EMAIL_OR_PASSWORD_MESSAGE, $data) {
        parent::__construct($message, $data);
    }

    public function getData()
    {
        return parent::getData();
    }
}