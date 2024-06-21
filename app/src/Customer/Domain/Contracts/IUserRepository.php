<?php
namespace App\src\Customer\Domain\Contracts;

interface IUserRepository
{
    public function saveUser($data);
    public function rolAttach($userId, $roleId);
    public function saveProfile($data);
}