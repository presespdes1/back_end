<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\src\Customer\Application\Services\AuthenticationService;
use App\src\Customer\Domain\DTOs\RegisterDtoBuilder;
use App\src\Customer\Domain\Exceptions\InvalidRegisterArgumentException;
use App\src\Response\Domain\Contracts\ICustomResponse;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;
    private $registerDtoBuilder;
    private $customResponse;

    public function __construct(
        AuthenticationService $service, 
        RegisterDtoBuilder $registerBuilder,
        ICustomResponse $customResponse       
    )
    {
        $this->authService = $service;
        $this->registerDtoBuilder = $registerBuilder;
        $this->customResponse = $customResponse;
    }
    
    public function login(Request $request){
        
    }

    public function register(Request $request)
    {
        try{
            $registerDto = $this->registerDtoBuilder       
                ->setName($request->name)
                ->setEmail($request->email)
                ->setPassword($request->password)
                ->setPasswordConfirmation($request->password_confirmation)
                ->build();  
            $customer = $this->authService->customerRegister($registerDto);
         
            return $this->customResponse->responseTo(
                true,
                "Registrado satisfactoriamente",
                $customer->toArrayResponse(),
                201
            );
                
        }
        catch (InvalidRegisterArgumentException $ex) {
            return $this->customResponse->responseTo(
                false,
                $ex->getMessage(),
                $ex->getData(),
                422
            );
        }
        catch (Exception $ex)
        {
            return $this->customResponse->responseTo(
                false,
                $ex->getMessage(),
                "",
                $ex->getCode()
            );
        }
       
      
    }

    public function logout()
    {

    }

    public function refresh()
    {
        
    }
}
