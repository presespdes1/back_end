<?php
namespace App\src\Customer\Domain\Contracts;

use App\src\Customer\Domain\Entities\CustomerEntity;

interface IAuthentication
{
    public function getCustomerAuthenticated();
    
    public function login($data);

    public function logout();

    public function refresh();
}
