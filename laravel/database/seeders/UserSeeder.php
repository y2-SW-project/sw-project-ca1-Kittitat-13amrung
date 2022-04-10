<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;
use App\Models\Artist;
use App\Models\Request;
use Hash;
use HasFactory;

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
        $user1 = new User();
        $user1->name = "Louise Carte";
        $user1->email = "louisec@gmail.com";
        $user1->password = Hash::make('password');
        $user1->save();

        // attach user to the ordinary user role
        $user1->roles()->attach($role_user);
        $user1->roles()->attach($role_traditional_artist);
        $user1->roles()->attach($role_pixel_artist);

        $users = User::factory()->count(30)->create()->each(function ($user) {
            $role_user = Role::where('name', 'user')->first();
            $user->roles()->attach($role_user);

            $artist = Artist::factory()->create([
                'user_id' => $user->id
            ]);

            $request = Request::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }
}
