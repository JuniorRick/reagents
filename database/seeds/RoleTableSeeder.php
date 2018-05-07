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
      $role_user = Role::create(['name' => 'user']);
      $role_visitor = Role::create(['name' => 'visitor']);

      $permission_create = Permission::create(['name' => 'create']);
      $permission_delete = Permission::create(['name' => 'delete']);
      $permission_show = Permission::create(['name' => 'show']);

      $role_admin->givePermissionTo([$permission_create,
        $permission_show, $permission_delete]);
      $role_user->givePermissionTo([$permission_create, $permission_show]);
      $role_visitor->givePermissionTo($permission_show);

      
    }
}
