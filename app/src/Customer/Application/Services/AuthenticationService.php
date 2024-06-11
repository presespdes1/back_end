<?php
namespace App\src\Customer\Application\Services;

use App\src\Customer\Domain\Contracts\IAuthentication;
use App\src\Customer\Domain\DTOs\RegisterDto;
use App\src\Customer\Domain\Entities\CustomerEntity;
use App\src\Customer\Domain\Entities\CustomerEntityBuilder;
use Nette\NotImplementedException;

class AuthenticationService
{
    private $authService;
    private $customerBuilder;

    public function __construct(IAuthentication $service, CustomerEntityBuilder $customerBuilder)
    {
        $this->authService = $service;
        $this->customerBuilder = $customerBuilder;
    }

    public function customerRegister(RegisterDto $registerDto)
    {
        //Registro
         $customerRegistered = $this->authService->register($registerDto->toArray());
        //Login
         $token = $this->authService->login([
            'email' => $registerDto->getEmail(),
            'password' => $registerDto->getPassword()
         ]);dd($token);
         //Customer's Entity
         return $this->customerBuilder
            ->setToken($token)
            ->setId($customerRegistered->getId())
            ->setName($customerRegistered->getName())
            ->setRole($customerRegistered->getRole())
            ->build();

    }
}