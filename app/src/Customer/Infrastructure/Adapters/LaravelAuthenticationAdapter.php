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
        $user = User::find(Auth::user()->id);
        return $this->customerEntityBuilder
            ->setId($user->id)
            ->setName($user->name)
            ->setEmail($user->email)
            ->setRole($user->roles()->first()->name)        
            ->build();
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
        
    }

    public function refresh()
    {
        
    }
}