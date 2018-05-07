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
        $role_user = Role::where('name', 'user')->first();
        $role_visitor = Role::where('name', 'visitor')->first();

        $admin = new App\User();
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin123');
        $admin->save();
        $admin->assignRole($role_admin);

        $user = new App\User();
        $user->name = 'user';
        $user->email = 'user@user.com';
        $user->password = bcrypt('user123');
        $user->save();
        $user->assignRole($role_user);

        $visitor = new App\User();
        $visitor->name = 'visitor';
        $visitor->email = 'visitor@visitor.com';
        $visitor->password = bcrypt('visitor123');
        $visitor->save();
        $visitor->assignRole($role_visitor);
    }
}
