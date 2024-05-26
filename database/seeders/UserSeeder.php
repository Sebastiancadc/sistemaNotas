<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user
        $user = User::create([
            'name' => 'John Admin',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
        ]);

        $role = Role::where('name', 'admin')->first();
        $user->assignRole($role);

        $user = User::create([
            'name' => 'John worker',
            'email' => 'johnworker@example.com',
            'password' => Hash::make('password123'),
        ]);
            
        $role = Role::where('name', 'worker')->first();
        $user->assignRole($role);
    }
}
