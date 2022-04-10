<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->randomHtml(10,8),
            'commercial_use' => $this->faker->boolean,
            'duration' => $this->faker->randomNumber(2, false),
            'start_price' => $this->faker->randomNumber(3, false),
            'end_price' => $this->faker->randomNumber(3, true),
            'status' => $this->faker->boolean,
        ];
    }
    
}
