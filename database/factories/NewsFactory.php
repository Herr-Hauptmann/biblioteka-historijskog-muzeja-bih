<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        // Define the directory path
        $directory = 'news';

        // Ensure the directory exists
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Fetch the image from the URL and save it with a random name
        $imageContent = Http::get('https://picsum.photos/500')->body();
        $imageName = uniqid() . '.jpg';
        $filePath = "{$directory}/{$imageName}";
        Storage::put($filePath, $imageContent);

        // Get the full URL for the image (adjust this based on your app's storage disk configuration)
        $imagePath = Storage::url($filePath);

        // Generate an article with random paragraphs
        $article = "<h1>" . $this->faker->realText(50) . "</h1>";
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        foreach ($paragraphs as $para) {
            $article .= "<p>{$para}</p>";
        }

        return [
            'title' => $this->faker->unique()->bs,
            'description' => $this->faker->sentence(10, true),
            'article' => $article,
            'image_path' => $imagePath, // Store the relative path or full URL
        ];
    }
}