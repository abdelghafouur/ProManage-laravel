<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('123'), 
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Assign roles based on user type (replace with your logic)
            switch ($user->type) {
                case 1:
                    $role = Role::findByName('superadmin');
                    break;
                case 2:
                    $role = Role::findByName('admin');
                    break;
                case 3:
                    $role = Role::findByName('comptable');
                    break;
                default:
                    $role = null;
            }

            if ($role) {
                $user->assignRole($role);
            }
        });
    }
}
