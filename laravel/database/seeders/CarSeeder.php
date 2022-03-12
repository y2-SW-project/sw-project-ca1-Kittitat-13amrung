<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeding data of car 1 into the car table
        $car_01 = new Car();
        $car_01->make = "MINI";
        $car_01->model = "COOPER";
        $car_01->price = "13500";
        $car_01->engine_size = "1.6";
        $car_01->image_location = "";
        $car_01->save();

        // seeding data of car 2 into the car table
        $car_02 = new Car();
        $car_02->make = "Toyota";
        $car_02->model = "Yaris";
        $car_02->price = "23900";
        $car_02->engine_size = "2.0";
        $car_02->image_location = "";
        $car_02->save();
    }
}
