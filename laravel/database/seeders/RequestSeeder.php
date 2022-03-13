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
        $request01->title = "Commission mountain painting";
        $request01->commission = "digital art";
        $request01->commercial_use = "yes";
        $request01->descriptions = "13500";
        $request01->start_date = "2022-03-09";
        $request01->end_date = "2022-03-12";
        $request01->start_price = "100";
        $request01->end_price = "200";
        $request01->genre_id = "0";
        $request01->save();
    }
}
