<?php
namespace App\src\Response\Domain\Contracts;

interface ICustomResponse
{
    public function responseTo($success, $message, $data, $respondeCode);    
}