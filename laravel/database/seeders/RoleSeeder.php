<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeding data of admin role into the roles table
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An Administrator user';
        $role_admin->save();

        // seeding data of user role into the roles table
        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'An Ordinary user';
        $role_user->save();

                // seeding data of user role into the roles table
        $role_artist = new Role();
        $role_artist->name = 'artist';
        $role_artist->description = 'An artist that takes commission from client(s)';
        $role_artist->save();

    }
}
