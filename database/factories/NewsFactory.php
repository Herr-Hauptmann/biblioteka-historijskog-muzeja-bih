<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $filePath = Storage::path('public/news');
        $imagePath = $this->faker->image($dir = $filePath, $width = 640, $height = 480);
        $imagePath = str_replace($filePath.'\\', 'news/', $imagePath);
        $article = "<h1>".$this->faker->realText(50)."</h1>";
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        foreach ($paragraphs as $para) {
            $article .= "<p>{$para}</p>";
        }

        return [
            'title' => $this->faker->unique()->bs,
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'article' => $article,
            'image_path' => $imagePath,
        ];
    }
}
