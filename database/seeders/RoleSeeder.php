<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'customer'
        ]);
        Role::create([
            'name' => 'guest'
        ]);
        $users = User::all();
        $rolId = Role::where('name', '=', 'customer')->get(['id']);
        foreach($users as $user){
            $user->roles()->attach($rolId);
        }
    }
}
