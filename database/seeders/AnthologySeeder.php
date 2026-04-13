<?php

namespace Database\Seeders;

use App\Models\Anthology;
use Illuminate\Database\Seeder;

class AnthologySeeder extends Seeder
{
    public function run(): void
    {
        Anthology::factory()
            ->count(20)
            ->create();
    }
}
