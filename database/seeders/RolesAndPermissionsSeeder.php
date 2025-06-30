<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions pake index, create(hal buat data), store,  edit (lihat data edit), update, Delete

        // Dashboard 
        Permission::create(['name' => 'index_dashboard']);

        // Ticket
        Permission::create(['name' => 'index_tickets']);
        Permission::create(['name' => 'create_tickets']);
        Permission::create(['name' => 'store_tickets']);
        Permission::create(['name' => 'edit_tickets']);
        Permission::create(['name' => 'update_tickets']);

        // User
        Permission::create(['name' => 'index_users']);
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'store_users']);
        Permission::create(['name' => 'edit_users']);
        Permission::create(['name' => 'update_users']);

        // Ticket
        Permission::create(['name' => 'index_export']);


        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'karyawan']);
        $role->givePermissionTo(
            'index_dashboard',
            'index_tickets',
            'create_tickets',
            'store_tickets',
            'edit_tickets',
            'update_tickets',
            'index_export',
        );

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
