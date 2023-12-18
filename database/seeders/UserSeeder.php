<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['type' => 1]); // Creates a user with 'superadmin' role
        User::factory()->create(['type' => 2]); // Creates a user with 'admin' role
        User::factory()->create(['type' => 3]); // Creates a user with 'comptable' role

    }
}
