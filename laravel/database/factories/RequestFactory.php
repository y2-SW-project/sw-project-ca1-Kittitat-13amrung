<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = 8, $variableNbWords = true),
            'description' => $this->faker->randomHtml(10,8),
            'traditional_art' => $this->faker->boolean,
            'digital_art' => $this->faker->boolean,
            'pixel_art' => $this->faker->boolean,
            'commercial_use' => $this->faker->boolean,
            'start_date' => $this->faker->dateTimeBetween('-4 week', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+4 week'),
            'start_price' => $this->faker->randomNumber(3, false),
            'end_price' => $this->faker->randomNumber(3, true),
        ];
    }
}
