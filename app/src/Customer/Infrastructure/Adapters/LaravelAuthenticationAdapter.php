<?php
namespace App\src\Customer\Infrastructure\Adapters;

use App\Models\User;
use App\Models\UserProfile;
use App\src\Customer\Domain\Contracts\IAuthentication;
use App\src\Customer\Domain\Entities\CustomerEntityBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LaravelAuthenticationAdapter implements IAuthentication
{
    private $customerEntityBuilder;

    public function __construct(CustomerEntityBuilder $customerEntityBuilder)
    {
        $this->customerEntityBuilder = $customerEntityBuilder;
    }

    public function me()
    {
        
    }

    public function register($data)
    {
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
            ->setPassword($customer->password)
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