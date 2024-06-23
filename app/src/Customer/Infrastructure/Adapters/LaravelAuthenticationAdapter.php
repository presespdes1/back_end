<?php
namespace App\src\Customer\Infrastructure\Adapters;

use App\Models\User;
use App\Models\UserProfile;
use App\src\Customer\Domain\Contracts\IAuthentication;
use App\src\Customer\Domain\Entities\CustomerEntityBuilder;
use App\src\Customer\Domain\Exceptions\InvalidLoginArgumentException;
use App\src\Customer\Domain\Exceptions\InvalidLoginArgumentExceptionBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaravelAuthenticationAdapter implements IAuthentication
{
    private $customerEntityBuilder;
    private $loginExceptionBuilder; 

    public function __construct(
        CustomerEntityBuilder $customerEntityBuilder,
        InvalidLoginArgumentExceptionBuilder $loginExceptionBuilder
    )
    {
        $this->customerEntityBuilder = $customerEntityBuilder;
        $this->loginExceptionBuilder = $loginExceptionBuilder;        
    }

    public function getCustomerAuthenticated()
    {
        $user = $this->getUserAuthenticated();
        $token = Auth::tokenById($user->id);
        return $this->getCustomerEntity($user, $token);
    }

  
    public function login($data)
    {
        $validateData = Validator::make($data, [
            'email' => 'required|email',            
            'password' => 'required|min:6'            
        ]);       
        if($validateData->fails()){
            throw $this->loginExceptionBuilder
                ->setData($validateData->errors())
                ->build();
        }
        
        return Auth::attempt($data);
    }

    public function logout()
    {
        $user = $this->getUserAuthenticated();
        Auth::logout();
        return $this->getCustomerEntity($user);

    }

    public function refresh()
    {
        $user = $this->getUserAuthenticated();
        $token = Auth::refresh();
        return $this->getCustomerEntity($user, $token);
    }

    private function getCustomerEntity($user = null, $token = null)
    {
        return $this->customerEntityBuilder
        ->setId($user->id)
        ->setName($user->name)
        ->setEmail($user->email)
        ->setToken($token)
        ->setRole($user->roles()->first()->name)        
        ->build();
    }

    private function getUserAuthenticated()
    {
        return User::find(Auth::user()->id);
    }
}