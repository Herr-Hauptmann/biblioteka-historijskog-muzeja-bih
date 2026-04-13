<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class AnthologyFactory extends Factory
{
    public function definition(): array
    {
        $documentName = 'example'.$this->faker->unique()->randomNumber($nbDigits = null, $strict = false).'.pdf';
        Storage::putFileAs('anthologies/', new File('resources/docs/example.pdf'), $documentName);

        return [
            'title' => $this->faker->unique()->bs,
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'file_path' => 'public/anthologies/'.$documentName,
        ];
    }
}
