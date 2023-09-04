<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //MISC
        $miscPermission = Permission::create(['name' => 'N/A']);

        // Filament-User
        $loginPermission1 = Permission::create(['name' => 'Admin: Login']);
        $loginPermission2 = Permission::create(['name' => 'Company: Dasboard']);
        $loginPermission3 = Permission::create(['name' => 'Sales: Dasboard']);

        //USER MODEL
        $userPermission1 = Permission::create(['name' => 'create: user']);
        $userPermission2 = Permission::create(['name' => 'read: user']);
        $userPermission3 = Permission::create(['name' => 'update: user']);
        $userPermission4 = Permission::create(['name' => 'delete: user']);

        //ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create: role']);
        $rolePermission2 = Permission::create(['name' => 'read: role']);
        $rolePermission3 = Permission::create(['name' => 'update: role']);
        $rolePermission4 = Permission::create(['name' => 'delete: role']);

        //PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create: permission']);
        $permission2 = Permission::create(['name' => 'read: permission']);
        $permission3 = Permission::create(['name' => 'update: permission']);
        $permission4 = Permission::create(['name' => 'delete: permission']);

        //ADMINS
        $adminPermission1 = Permission::create(['name' => 'read: admin']);
        $adminPermission2 = Permission::create(['name' => 'update: admin']);

        // CREATE ROLES
        $userRole = Role::create(['name' => 'user'])->syncPermissions([
        $miscPermission,
        $loginPermission3
        ]);


        $superAdminRole = Role::create(['name' => 'super-admin'])->syncPermissions([
        $userPermission1,
        $userPermission2,
        $userPermission3,
        $userPermission4,
        $rolePermission1,
        $rolePermission2,
        $rolePermission3,
        $rolePermission4,
        $permission1,
        $permission2,
        $permission3,
        $permission4,
        $adminPermission1,
        $adminPermission2,
        $userPermission1,
        $loginPermission1,
        $loginPermission2,
        $loginPermission3
        ]);


        $businessRole = Role::create(['name' => 'business-owner'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $userPermission1,
            $loginPermission1,
            $loginPermission2,
            $loginPermission3
            ]);


        $adminRole = Role::create(['name' => 'admin'])->syncPermissions([
        $userPermission1,
        $userPermission2,
        $userPermission3,
        $userPermission4,
        $rolePermission1,
        $rolePermission2,
        $rolePermission3,
        $rolePermission4,
        $permission1,
        $permission2,
        $permission3,
        $permission4,
        $adminPermission1,
        $adminPermission2,
        $userPermission1,
        $loginPermission1,
        $loginPermission2,
        $loginPermission3
        ]);

        $moderatorRole = Role::create(['name' => 'moderator'])->syncPermissions([
        $userPermission2,
        $rolePermission2,
        $permission2,
        $adminPermission1,
        $loginPermission3
        ]);


        $developerRole = Role::create(['name' => 'developer'])->syncPermissions([
        $adminPermission1,
        ]);

        User::create([
        'name' => 'super admin',
        'email' => 'super@admin.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10)
        ])->assignRole($superAdminRole);

        User::create([
            'name' => 'business owner',
            'email' => 'business@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
            ])->assignRole($businessRole);

        User::create([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10)
        ])->assignRole($adminRole);


        User::create([
        'name' => 'moderator',
        'email' => 'moderator@admin.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10)
        ])->assignRole($moderatorRole);


        User::create([
        'name' => 'developer',
        'email' => 'developer@admin.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10)
        ])->assignRole($developerRole);

        for ($i = 0; $i <= 5; $i++) {
        User::create([
        'name' => 'Test '.$i,
        'email' => 'test'.$i.'@admin.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10)
        ])->assignRole($userRole);
        }
    }
}
