<?php

namespace Database\Seeders;

use App\Models\Request;
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
        $request01->title = "Commission mountain painting 1";
        $request01->digital_art = true;
        $request01->commercial_use = "yes";
        $request01->descriptions = "13500";
        $request01->start_date = "2022-03-09";
        $request01->end_date = "2021-03-12";
        $request01->start_price = "100";
        $request01->end_price = "200";
        $request01->genre_id = "0";
        $request01->save();

        $request02 = new Request();
        $request02->title = "Commission mountain painting 2";
        $request02->digital_art = true;
        $request02->commercial_use = "no";
        $request02->descriptions = "13500";
        $request02->start_date = "2022-03-09";
        $request02->end_date = "2023-05-12";
        $request02->start_price = "100";
        $request02->end_price = "200";
        $request02->genre_id = "0";
        $request02->save();

        $request03 = new Request();
        $request03->title = "Commission mountain painting 3";
        $request03->pixel_art = true;
        $request03->commercial_use = "yes";
        $request03->descriptions = "13500";
        $request03->start_date = "2022-03-09";
        $request03->end_date = "2022-04-11";
        $request03->start_price = "100";
        $request03->end_price = "200";
        $request03->genre_id = "0";
        $request03->save();

        $request04 = new Request();
        $request04->title = "Commission mountain painting 4";
        $request04->traditional_art = true;
        $request04->commercial_use = "no";
        $request04->descriptions = "13500";
        $request04->start_date = "2023-03-09";
        $request04->end_date = "2024-03-12";
        $request04->start_price = "100";
        $request04->end_price = "200";
        $request04->genre_id = "0";
        $request04->save();
    }
}
