<?php
namespace App\src\Customer\Domain\Contracts;

use App\src\Customer\Domain\Entities\CustomerEntity;

interface IAuthentication
{
    public function me();

    public function register($data);

    public function login($data);

    public function logout();

    public function refresh();
}
