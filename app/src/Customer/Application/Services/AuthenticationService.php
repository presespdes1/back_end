<?php
namespace App\src\Customer\Application\Services;

use App\src\Customer\Domain\Contracts\IAuthentication;
use App\src\Customer\Domain\Entities\CustomerEntity;
use Nette\NotImplementedException;

class AuthenticationService implements IAuthentication
{
    public function me(): CustomerEntity
    {
        throw new NotImplementedException;
    }

    public function register(): CustomerEntity
    {
        throw new NotImplementedException;        
    }

    public function login(): CustomerEntity
    {
        throw new NotImplementedException;
    }

    public function logout(): CustomerEntity
    {
        throw new NotImplementedException;        
    }

    public function refresh(): CustomerEntity
    {
        throw new NotImplementedException;
    }
}