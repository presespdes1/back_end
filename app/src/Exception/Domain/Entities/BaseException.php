<?php
namespace App\src\Exception\Domain\Entities;

use InvalidArgumentException;

class BaseException extends InvalidArgumentException
{
    protected $data;

    public function __construct($message = "", $data = null) {
        parent::__construct($message);
        $this->data = $data;
    }

    protected function getData()
    {
        return $this->data;
    }
}