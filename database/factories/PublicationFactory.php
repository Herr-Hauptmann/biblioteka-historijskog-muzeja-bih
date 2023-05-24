<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class PublicationFactory extends Factory
{
    public function definition()
    {
        $documentName = 'example'.$this->faker->unique()->randomNumber($nbDigits = NULL, $strict = false).'.pdf';
        $path = Storage::putFileAs('publications/', new File('resources/docs/example.pdf'), $documentName);
        return [
            'title' => $this->faker->unique()->bs,
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'file_path' => 'publications/'.$documentName,
        ];
    }
}
