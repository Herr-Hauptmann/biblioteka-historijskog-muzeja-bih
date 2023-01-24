<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            "title" => $this->faker->unique()->bs,
            "year_published" => $this->faker->year($max = 'now'),
            "inventory_number" => $this->faker->unique()->randomNumber,
            "signature" => $this->faker->unique()->ean8,
            "number_of_units" => $this->faker->randomDigit,
            "publisher" => $this->faker->company,
            "location_published" => $this->faker->city,
        ];
    }
}
