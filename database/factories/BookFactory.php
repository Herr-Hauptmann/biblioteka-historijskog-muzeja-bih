<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'writer' => $this->faker->unique()->name($gender = null),
            'title' => $this->faker->unique()->catchPhrase(),
            'year_published' => $this->faker->year($max = 'now'),
        ];
    }
}
