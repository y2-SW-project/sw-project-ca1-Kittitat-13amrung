<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request01 = new Request();
        $request01->title = "Test";
        $request01->traditional_art = true;
        $request01->digital_art = false;
        $request01->pixel_art = false;
        $request01->commercial_use = true;
        $request01->description = "test";
        $request01->start_date = "2022-04-08";
        $request01->end_date = "2022-04-23";
        $request01->start_price = 40;
        $request01->end_price = 125;
        $request01->user_id = 2;
        $request01->save();
    }
}
