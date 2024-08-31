<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define role names and attributes
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'guard_name' => 'web',
            ],
        ];

        // Insert roles into the roles table
        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                [
                    'name' => $roleData['name'],
                    'guard_name' => $roleData['guard_name'],
                    'display_name' => $roleData['display_name'],
                ]
            );
        }

        // Retrieve the 'super_admin' role instance
        $superAdminRole = Role::where('name', 'super_admin')->first();

        // Create or update the admin user
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'cellphone' => '1234567890',
                'avatar' => 'default-avatar.png',
                'status' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'provider_name' => 'local',
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Assign the 'super_admin' role to the admin user
        $adminUser->roles()->attach($superAdminRole);
    }
}
