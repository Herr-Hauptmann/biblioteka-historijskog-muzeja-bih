<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Keyword;

class KeywordSeeder extends Seeder
{
    public function run()
    {
        Keyword::factory()
            ->count(20)
            ->create();
    }
}
