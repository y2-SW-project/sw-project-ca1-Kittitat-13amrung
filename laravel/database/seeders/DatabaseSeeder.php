<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Preload all the data in the following seeders
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RequestSeeder::class);
    }
}
