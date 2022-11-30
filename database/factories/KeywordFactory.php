<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KeywordFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word(),
        ];
    }
}
