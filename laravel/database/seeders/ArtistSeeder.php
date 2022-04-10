<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artist01 = new Artist();
        $artist01->description = "test";
        $artist01->duration = 20;
        $artist01->start_price = 25;
        $artist01->end_price = 100;
        $artist01->status = true;
        $artist01->user_id = 2;
        $artist01->save();

        // $artists = Artist::factory()->count(3)->create();
        // $users = Artist::factory()->count(3)->create();
    }
}
