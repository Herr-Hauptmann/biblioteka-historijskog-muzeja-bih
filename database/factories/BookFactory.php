<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            "title" => $this->faker->unique()->bs,
            "signature" => $this->faker->unique()->ean8,
            "inventory_number" => $this->faker->unique()->randomNumber,
            "publisher" => $this->faker->company,
            "year_published" => $this->faker->year($max = 'now'),
            "location_published" => $this->faker->city,
            "number_of_units" => $this->faker->randomDigit,
        ];
    }
}
