<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $agentRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'agent']);

        // Create a test admin user
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@pamoja.com'],
            [
                'name' => 'Admin User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // Create a test agent user
        $agent = \App\Models\User::firstOrCreate(
            ['email' => 'agent@pamoja.com'],
            [
                'name' => 'Agent User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );
        $agent->assignRole($agentRole);
    }
}
