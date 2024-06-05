<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    private $i = 0;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->getUserID(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'avatar' => fake()->imageUrl(),            
        ];
    }

    private function getUserID()
    {
        $users = DB::table('users')
                // ->select('users.id')
                ->leftJoin('user_profiles', function(JoinClause $join){
                    $join->on('users.id', '=', 'user_profiles.user_id');
                            
                })
                ->whereNull('user_profiles.user_id')
                ->orderBy('users.id', 'asc')
                ->get(['users.id']);
                
        if($this->i === count($users)){
            $this->i = 0;
        }
        // dd($users->id);
        return $users[$this->i++]->id;
      
    }
}
