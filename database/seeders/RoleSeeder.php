<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;

//Modelo que viene de Spatie
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
        //*Roles
        $role_admin = Role::create(['name' => 'admin','description' => 'Administrador']);
        $role_customer = Role::create(['name' => 'customer','description' => 'Cliente']);
        $role_supervisor = Role::create(['name' => 'supervisor','description' => 'Supervisor']);

        $user = User::create([
            'name' => 'Brian',
            'email' => 'sct115xd@hotmail.com',
            'address' => 'Ana Maria Castellanos #182',
            'postal_code' => '47700',
            'location' => 'Capilla de Guadalupe',
            'municipality' => 'Tepatitlan de Morelos',
            'state' => 'Jalisco',
            'phone_number' => '3787313902',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole($role_admin);

        //!Users
        $permission_create_user = Permission::create(['name' => 'create.user','description' => 'Crear Usuarios']);
        $permission_read_user = Permission::create(['name' => 'read.user','description' => 'Ver Usuarios']);
        $permission_update_user = Permission::create(['name' => 'update.user','description' => 'Actualizar Usuarios']);
        $permission_delete_user = Permission::create(['name' => 'delete.user','description' => 'Borrar Usuarios']);

        //!Providers
        $permission_create_provider = Permission::create(['name' => 'create.provider','description' => 'Crear Proveedores']);
        $permission_read_provider = Permission::create(['name' => 'read.provider','description' => 'Ver Proveedores']);
        $permission_update_provider = Permission::create(['name' => 'update.provider','description' => 'Actualizar Proveedores']);
        $permission_delete_provider = Permission::create(['name' => 'delete.provider','description' => 'Borrar Proveedores']);

        //!Clothes
        $permission_create_clothes = Permission::create(['name' => 'create.clothes','description' => 'Crear Prendas']);
        $permission_read_clothes = Permission::create(['name' => 'read.clothes','description' => 'Ver Prendas']);
        $permission_update_clothes = Permission::create(['name' => 'update.clothes','description' => 'Actualizar Prendas']);
        $permission_delete_clothes = Permission::create(['name' => 'delete.clothes','description' => 'Borrar Prendas']);

        //!Orders
        $permission_create_order = Permission::create(['name' => 'create.order','description' => 'Crear Pedidos']);
        $permission_read_order = Permission::create(['name' => 'read.order','description' => 'Ver Pedidos']);
        $permission_update_order = Permission::create(['name' => 'update.order','description' => 'Actualizar Pedidos']);
        $permission_delete_order = Permission::create(['name' => 'delete.order','description' => 'Borrar Pedidos']);

        $permissions_admin = [
            $permission_create_user,
            $permission_read_user,
            $permission_update_user,
            $permission_delete_user,

            $permission_create_provider,
            $permission_read_provider,
            $permission_update_provider,
            $permission_delete_provider,

            $permission_create_clothes,
            $permission_read_clothes,
            $permission_update_clothes,
            $permission_delete_clothes,

            $permission_create_order,
            $permission_read_order,
            $permission_update_order,
            $permission_delete_order
        ];

        $permissions_supervisor = [
            $permission_create_provider,
            $permission_read_provider,
            $permission_update_provider,
            $permission_delete_provider,

            $permission_create_clothes,
            $permission_read_clothes,
            $permission_update_clothes,
            $permission_delete_clothes,

            $permission_create_order,
            $permission_read_order,
            $permission_update_order,
            $permission_delete_order
        ];

        $permissions_customer = [
            $permission_create_order,
        ];

        $role_admin -> syncPermissions($permissions_admin);
        $role_customer -> syncPermissions($permissions_customer);
        $role_supervisor -> syncPermissions($permissions_supervisor);
    }
}
