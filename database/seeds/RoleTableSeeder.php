<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = new Role();
        $role_super_admin->name = 'super-admin';
        $role_super_admin->description = 'Super super admin';
        $role_super_admin->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Ini adalah admin';
        $role_admin->save();

        $role_subscriber = new Role();
        $role_subscriber->name = 'subscriber';
        $role_subscriber->description = 'The Subscriber';
        $role_subscriber->save();
    }
}
