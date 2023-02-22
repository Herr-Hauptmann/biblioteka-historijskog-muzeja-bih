<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->bs,
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'file_path' => 'publications/example.pdf',
        ];
    }
}
