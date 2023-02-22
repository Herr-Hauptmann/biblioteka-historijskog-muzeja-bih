<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Book;
use App\Models\Author;
use App\Models\Keyword;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = Book::factory()
            ->count(200)
            ->create();
        $authors = Author::all();
        $keywords = Keyword::all();
        
        Book::all()->each(function ($book) use ($keywords, $authors) { 
            $book->keywords()->attach(
                $keywords->random(rand(1, 5))->pluck('id')->toArray()
            ); 
            $book->authors()->attach(
                $authors->random(rand(1, 5))->pluck('id')->toArray()
            ); 
        });
    }
}
