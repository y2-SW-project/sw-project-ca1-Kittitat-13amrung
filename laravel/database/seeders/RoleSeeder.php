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
        $role_traditional_artist = new Role();
        $role_traditional_artist->name = 'traditional artist';
        $role_traditional_artist->description = 'An artist who mainly draw traditional artsc';
        $role_traditional_artist->save();

        $role_pixel_artist = new Role();
        $role_pixel_artist->name = 'pixel artist';
        $role_pixel_artist->description = 'An artist who mainly draw pixelated illustrations';
        $role_pixel_artist->save();

        $role_digital_artist = new Role();
        $role_digital_artist->name = 'digital artist';
        $role_digital_artist->description = 'An artist who mainly draw illustrations on a digital format';
        $role_digital_artist->save();
    }
}
