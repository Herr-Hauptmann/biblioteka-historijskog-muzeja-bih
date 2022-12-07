<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Book;
use App\Models\Keyword;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::factory()
            ->count(2400)
            // ->has(Keyword::factory()->count(3))
            ->create();
    }
}
