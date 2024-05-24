<?php

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use App\Models\Workplace;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Faker\Factory as faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $permissions = [
            // Auth permissions
            ['name' => 'auth.login', 'guard_name' => 'api'],
            ['name' => 'auth.logout', 'guard_name' => 'api'],
            ['name' => 'auth.me', 'guard_name' => 'api'],
            ['name' => 'auth.refresh', 'guard_name' => 'api'],
            ['name' => 'auth.forgot-password', 'guard_name' => 'api'],
            ['name' => 'auth.change-password', 'guard_name' => 'api'],

            // Employee permissions
            ['name' => 'employee.view', 'guard_name' => 'api'],
            ['name' => 'employee.viewAny', 'guard_name' => 'api'],
            ['name' => 'employee.create', 'guard_name' => 'api'],
            ['name' => 'employee.update', 'guard_name' => 'api'],
            ['name' => 'employee.delete', 'guard_name' => 'api'],
            ['name' => 'employee.upload-avatar', 'guard_name' => 'api'],

            // Position permissions
            ['name' => 'position.view', 'guard_name' => 'api'],
            ['name' => 'position.viewAny', 'guard_name' => 'api'],
            ['name' => 'position.create', 'guard_name' => 'api'],
            ['name' => 'position.update', 'guard_name' => 'api'],
            ['name' => 'position.delete', 'guard_name' => 'api'],

            // Workplace permissions
            ['name' => 'workplace.view', 'guard_name' => 'api'],
            ['name' => 'workplace.viewAny', 'guard_name' => 'api'],
            ['name' => 'workplace.create', 'guard_name' => 'api'],
            ['name' => 'workplace.update', 'guard_name' => 'api'],
            ['name' => 'workplace.delete', 'guard_name' => 'api'],

            //Role Permission
            ['name' => 'role.view', 'guard_name' => 'api'],
            ['name' => 'role.create', 'guard_name' => 'api'],

            //Permission
            ['name' => 'permission.view', 'guard_name' => 'api'],
            ['name' => 'permission.create', 'guard_name' => 'api']
        ];

        Permission::insert($permissions);

        $roles = ['super-admin','admin-hr','employee'];
        foreach ($roles as $role) {
            Role::updateOrCreate(['name'=> $role,'guard_name'=> 'api']);
        }
        $permissionsAll = Permission::all();
        $find_role = Role::findByName('super-admin','api');
        $find_role->givePermissionTo($permissionsAll);



        Position::factory(5)->create();
        Workplace::factory(5)->create();

        $faker = faker::create('id_ID');

        Employee::create([
            'name' => $faker->name,
            'user_id'=> User::factory()->create()->id,
            'position_id'=> Position::factory()->create()->id,
            'workplace_id'=>Workplace::factory()->create()->id
        ]);

        $User_Admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'phone' => $faker->unique()->phoneNumber,
            'email_verified_at' => now(),
            'password' => bcrypt('Admin1234'),
            'remember_token' => Str::random(10),
        ]);

        $User_Admin->assignRole($find_role);
    }
}
