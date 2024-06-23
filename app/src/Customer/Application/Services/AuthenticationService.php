<?php
namespace App\src\Customer\Application\Services;

use App\src\Customer\Domain\Contracts\IAuthentication;
use App\src\Customer\Domain\Contracts\IUserRepository;
use App\src\Customer\Domain\DTOs\LoginDto;
use App\src\Customer\Domain\DTOs\RegisterDto;
use App\src\Customer\Domain\Entities\CustomerEntity;
use App\src\Customer\Domain\Entities\CustomerEntityBuilder;
use App\src\Customer\Domain\Exceptions\InvalidEmailOrPasswordException;
use App\src\Customer\Domain\Exceptions\InvalidEmailOrPasswordExceptionBuilder;
use App\src\Customer\Domain\Exceptions\InvalidLoginArgumentException;
use Nette\NotImplementedException;

class AuthenticationService
{
    private $authService;
    private $customerBuilder;
    private $userRepository;
    private $tokenExceptionBuilder;

    public function __construct(
        IAuthentication $service, 
        CustomerEntityBuilder $customerBuilder,
        IUserRepository $userRepository,
        InvalidEmailOrPasswordExceptionBuilder $tokenExceptionBuilder
        )
    {
        $this->authService = $service;
        $this->customerBuilder = $customerBuilder;
        $this->userRepository = $userRepository;
        $this->tokenExceptionBuilder = $tokenExceptionBuilder;
    }

    public function customerRegister(RegisterDto $registerDto)
    {
        //Registro
         $customerRegistered = $this->userRepository->saveUser($registerDto->toArray());
        //Login
         $token = $this->authService->login([
            'email' => $registerDto->getEmail(),
            'password' => $registerDto->getPassword()
         ]);
         //User's default profile save
         $this->userRepository->saveProfile(            
            [
                'user_id' => $customerRegistered->getId()
            ]
         );
         //User's role attach
         $userRole = $this->userRepository->rolAttach($customerRegistered->getId(), 2);
         
         //Customer's Entity
         return $this->customerBuilder
            ->setToken($token)
            ->setId($customerRegistered->getId())
            ->setName($customerRegistered->getName())
            ->setRole($userRole)
            ->build();

    }

    public function customerLogin(LoginDto $loginDto)
    {
        $token = $this->authService->login($loginDto->toArray());
        if(empty($token))
        {
            throw $this->tokenExceptionBuilder
                ->setData($loginDto->toArray())
                ->build();
        }
        return  $this->authService->getCustomerAuthenticated();
    }

    public function customerLogout()
    {
       return $this->authService->logout();
    }

    public function customerRefresh()
    {
        return $this->authService->refresh();
    }
}