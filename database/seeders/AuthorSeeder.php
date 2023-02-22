<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::factory()
            ->count(100)
            ->create();
    }
}
