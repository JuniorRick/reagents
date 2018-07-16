<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_admin = Role::create(['name' => 'admin']);
      $role_labor = Role::create(['name' => 'labor']);
      $role_depositor = Role::create(['name' => 'depositor']);
      $role_visitor = Role::create(['name' => 'visitor']);

      $permission_create_reagents = Permission::create(['name' => 'create reagents']);
      $permission_edit_reagents = Permission::create(['name' => 'edit reagents']);
      $permission_delete_reagents = Permission::create(['name' => 'delete reagents']);

      $permission_create_orders = Permission::create(['name' => 'create orders']);
      $permission_edit_orders = Permission::create(['name' => 'edit orders']);
      $permission_delete_orders = Permission::create(['name' => 'delete orders']);

      $permission_create_reports = Permission::create(['name' => 'create reports']);
      $permission_edit_reports = Permission::create(['name' => 'edit reports']);
      $permission_delete_reports = Permission::create(['name' => 'delete reports']);

      $permission_create_data = Permission::create(['name' => 'create data']);
      $permission_edit_data = Permission::create(['name' => 'edit data']);
      $permission_delete_data = Permission::create(['name' => 'delete data']);


      $permission_create = Permission::create(['name' => 'create']);
      $permission_edit = Permission::create(['name' => 'edit']);
      $permission_delete = Permission::create(['name' => 'delete']);
      $permission_view = Permission::create(['name' => 'view']);

      $role_admin->givePermissionTo([$permission_create, $permission_edit,
        $permission_delete, $permission_view]);

      $role_labor->givePermissionTo([$permission_create_reports,
        $permission_edit_reports, $permission_view]);

      $role_depositor->givePermissionTo([$permission_create_orders,
        $permission_edit_orders, $permission_view]);

      $role_visitor->givePermissionTo($permission_view);


    }
}
