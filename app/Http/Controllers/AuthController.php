<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\src\Customer\Application\Services\AuthenticationService;
use App\src\Customer\Domain\DTOs\LoginDtoBuilder;
use App\src\Customer\Domain\DTOs\RegisterDtoBuilder;
use App\src\Customer\Domain\Exceptions\InvalidEmailOrPasswordException;
use App\src\Customer\Domain\Exceptions\InvalidLoginArgumentException;
use App\src\Customer\Domain\Exceptions\InvalidRegisterArgumentException;
use App\src\Response\Domain\Contracts\ICustomResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;
    private $registerDtoBuilder;
    private $loginDtoBuilder;
    private $customResponse;

    public function __construct(
        AuthenticationService $service, 
        RegisterDtoBuilder $registerBuilder,
        LoginDtoBuilder $loginDtoBuilder,
        ICustomResponse $customResponse       
    )
    {
        $this->authService = $service;
        $this->registerDtoBuilder = $registerBuilder;
        $this->loginDtoBuilder = $loginDtoBuilder;
        $this->customResponse = $customResponse;
    }
    
    public function login(Request $request){
        try {
            $loginDto = $this->loginDtoBuilder
            ->setEmail($request->email)
            ->setPassword($request->password)
            ->build();
        $customer = $this->authService->customerLogin($loginDto);
        return $this->customResponse->responseTo(
            true,
            "Logueado satisfactoriamente",
            $customer->toArrayResponse(),
            200
        );
        } catch (InvalidLoginArgumentException $ex) {
            return $this->customResponse->responseTo(
                false,
                $ex->getMessage(),
                $ex->getData(),
                422
            );
        } catch (InvalidEmailOrPasswordException $ex) {
            return $this->customResponse->responseTo(
                false,
                $ex->getMessage(),
                $ex->getData(),
                422
            );
        }


        
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
                500//$ex->getCode()
            );          
        }
       
      
    }

    public function logout()
    {
        $customer = $this->authService->customerLogout();
        return $this->customResponse->responseTo(
            true,
            "Cliente deslogueado satisfactoriamente",
            $customer->toArrayResponse(),
            200
        );
    }

    public function refresh()
    {
        $customer = $this->authService->customerRefresh();
        return $this->customResponse->responseTo(
            true,
            "Token refrescado satisfactoriamente",
            $customer->toArrayResponse(),
            200
        );
    }
}
