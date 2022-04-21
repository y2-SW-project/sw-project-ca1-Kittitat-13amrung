<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;
use App\Models\Artist;
use App\Models\Request;
use Hash;
use HasFactory;
use Illuminate\Support\Str;

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
        $role_artist = Role::where('name', 'artist')->first();

        // seeding data of new user into the users table
        $admin = new User();
        $admin->name = "sad.tanukiz";
        $admin->email = "n00201327@iadt.ie";
        $admin->password = Hash::make('password');
        $admin->remember_token = Str::random(10);
        $admin->save();

        // attach user to the admin role
        $admin->roles()->attach($role_admin);
        $admin->roles()->attach($role_artist);

        // seeding data of new user role into the users table
        $user1 = new User();
        $user1->name = "Louise Carte";
        $user1->email = "louisec@gmail.com";
        $user1->password = Hash::make('password');
        $user1->remember_token = Str::random(10);
        $user1->save();

        // attach user to the ordinary user role
        $user1->roles()->attach($role_user);


        $users = User::factory()->count(20)->create()->each(function ($user) {
            $role_user = Role::where('name', 'user')->first();
            $role_artist = Role::where('name', 'artist')->first();
            $user->roles()->attach($role_user);
            $user->roles()->attach($role_artist);

            $artist = Artist::factory()->count(1)->create([
                'user_id' => $user->id
            ]);

            $request = Request::factory()->count(1)->create([
                'user_id' => $user->id
            ]);
        });

        $users = User::factory()->count(30)->create()->each(function ($user) {
            $role_user = Role::where('name', 'user')->first();
            $user->roles()->attach($role_user);
        });
    }
}
