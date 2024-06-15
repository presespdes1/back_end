<?php
namespace App\src\Customer\Infrastructure\Adapters;

use App\Models\User;
use App\Models\UserProfile;
use App\src\Customer\Domain\Contracts\IAuthentication;
use App\src\Customer\Domain\Entities\CustomerEntityBuilder;
use App\src\Customer\Domain\Exceptions\InvalidRegisterArgumentException;
use App\src\Customer\Domain\Exceptions\InvalidRegisterArgumentExceptionBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaravelAuthenticationAdapter implements IAuthentication
{
    private $customerEntityBuilder;
    private $registerDataExceptionBuilder;

    public function __construct(
        CustomerEntityBuilder $customerEntityBuilder,
        InvalidRegisterArgumentExceptionBuilder $registerDataExceptionBuilder
    )
    {
        $this->customerEntityBuilder = $customerEntityBuilder;
        $this->registerDataExceptionBuilder = $registerDataExceptionBuilder;
    }

    public function me()
    {
        $user = User::find(Auth::user()->id);
        return $this->customerEntityBuilder
            ->setId($user->id)
            ->setName($user->name)
            ->setEmail($user->email)
            ->setRole($user->roles()->first()->name)        
            ->build();
    }

    public function register($data)
    {
        $validateData = Validator::make($data, [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ]);       
        if($validateData->fails())
        {
            throw $this->registerDataExceptionBuilder
                ->setData($validateData->errors())
                ->build();
        }
        //User save
        $customer = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $customer->save();

        //User's profile default save
        UserProfile::create([
            'user_id' => $customer->id          
        ])->save();

        //User's role attach
        $customer->roles()->attach(2);

        //User's Entity  
        return $this->customerEntityBuilder
            ->setId($customer->id)
            ->setName($customer->name)
            ->setEmail($customer->email)
            ->setRole($customer->roles()->first()->name)            
            ->build();
    }

    public function login($data)
    {
        return Auth::attempt($data);
    }

    public function logout()
    {
        
    }

    public function refresh()
    {
        
    }
}