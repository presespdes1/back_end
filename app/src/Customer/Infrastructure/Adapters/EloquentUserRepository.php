<?php
namespace App\src\Customer\Infrastructure\Adapters;

use App\Models\User;
use App\Models\UserProfile;
use App\src\Customer\Domain\Contracts\IUserRepository;
use App\src\Customer\Domain\Entities\CustomerEntityBuilder;
use App\src\Customer\Domain\Exceptions\InvalidRegisterArgumentExceptionBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EloquentUserRepository implements IUserRepository
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

    public function saveUser($data)
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
        //User's Entity  
        return $this->customerEntityBuilder
            ->setId($customer->id)
            ->setName($customer->name)
            ->setEmail($customer->email)                      
            ->build();
    }

    public function rolAttach($userId, $roleId)
    {
        $user = User::find($userId);
        $user->roles()->attach($roleId);
        return $user->roles()->first()->name;
    }

    public function saveProfile($data)
    {
        UserProfile::create($data)->save();
    }
}