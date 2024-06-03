<?php
namespace App\src\Customer\Domain\Contracts;

use App\src\Customer\Domain\Entities\CustomerEntity;

interface IAuthentication
{
    public function me():CustomerEntity;

    public function register():CustomerEntity;

    public function login(): CustomerEntity;

    public function logout(): CustomerEntity;

    public function refresh(): CustomerEntity;
}
