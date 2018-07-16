<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_labor = Role::where('name', 'labor')->first();
        $role_depositor = Role::where('name', 'depositor')->first();
        $role_visitor = Role::where('name', 'visitor')->first();

        $admin = new App\User();
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin123');
        $admin->save();
        $admin->assignRole($role_admin);

        $labor = new App\User();
        $labor->name = 'labor';
        $labor->email = 'labor@labor.com';
        $labor->password = bcrypt('labor123');
        $labor->save();
        $labor->assignRole($role_labor);

        $depositor = new App\User();
        $depositor->name = 'depositor';
        $depositor->email = 'depositor@depositor.com';
        $depositor->password = bcrypt('depositor123');
        $depositor->save();
        $depositor->assignRole($role_depositor);

        $visitor = new App\User();
        $visitor->name = 'visitor';
        $visitor->email = 'visitor@visitor.com';
        $visitor->password = bcrypt('visitor123');
        $visitor->save();
        $visitor->assignRole($role_visitor);
    }
}
