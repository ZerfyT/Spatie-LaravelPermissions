<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'publish']);

        // Create Roles and asign existing Permissions
        $role1 = Role::create(['name' => 'customer']);

        $role2 = Role::create(['name' => 'meter_reader']);
        $role2->givePermissionTo('publish');

        $role3 = Role::create(['name' => 'admin']);
        $role3->givePermissionTo('edit');
        $role3->givePermissionTo('delete');
        $role3->givePermissionTo('publish');

        // Create Demo Users
        $user = User::factory()->create([
            'name' => 'ExampleUser',
            'email' => 'example@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role1);

        $user = User::factory()->create([
            'name' => 'ExampleMeterReader',
            'email' => 'example2@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'ExampleAdmin',
            'email' => 'example3@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role3);


    }
}
