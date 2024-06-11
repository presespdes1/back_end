<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\src\Customer\Application\Services\AuthenticationService;
use App\src\Customer\Domain\DTOs\RegisterDtoBuilder;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;
    private $registerDtoBuilder;

    public function __construct(AuthenticationService $service, RegisterDtoBuilder $registerBuilder)
    {
        $this->authService = $service;
        $this->registerDtoBuilder = $registerBuilder;
    }
    
    public function login(){

    }

    public function register(Request $request)
    {
       $registerDto = $this->registerDtoBuilder       
            ->setName($request->name)
            ->setEmail($request->email)
            ->setPassword($request->password)
            ->build();  
      $customer = $this->authService->customerRegister($registerDto);
      dd($customer);
    }

    public function logout()
    {

    }

    public function refresh()
    {
        
    }
}
