<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add role
        $roles = [
          [
            'name'  => 'root',
            'display_name'  => 'root',
            'description' => 'Root user',
          ],
          [
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin user',
          ],
          [
            'name'  => 'user',
            'display_name' => 'Registered User',
            'description' => 'Access for registered user',
          ],
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }

        // added default user
        $users = [
          [
            'name' => 'root',
            'email' => 'root@maulsama.com',
            'password' => bcrypt('123456'),
          ],

        ];

        $n = 1;
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->attachRole($n);
            $n++;
        }
    }
}
