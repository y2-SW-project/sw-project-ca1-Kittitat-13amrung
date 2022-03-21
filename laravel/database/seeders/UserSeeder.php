<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Hash;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // declaring role variables to be later assigned to a user
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();
        $role_traditional_artist = Role::where('name', 'traditional artist')->first();
        $role_digital_artist = Role::where('name', 'digital artist')->first();
        $role_pixel_artist = Role::where('name', 'pixel artist')->first();

        // seeding data of new user into the users table
        $admin = new User();
        $admin->name = "sad.tanukiz";
        $admin->email = "n00201327@iadt.ie";
        $admin->password = Hash::make('password');
        $admin->save();

        // attach user to the admin role
        $admin->roles()->attach($role_admin);
        $admin->roles()->attach($role_digital_artist);

        // seeding data of new user role into the users table
        $user = new User();
        $user->name = "Louise Carte";
        $user->email = "louisec@gmail.com";
        $user->password = Hash::make('password');
        $user->save();

        // attach user to the ordinary user role
        $user->roles()->attach($role_user);
        $user->roles()->attach($role_traditional_artist);
        $user->roles()->attach($role_pixel_artist);

    }
}
