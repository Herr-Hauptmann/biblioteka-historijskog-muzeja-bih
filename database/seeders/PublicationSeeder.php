<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Publication;


class PublicationSeeder extends Seeder
{
    public function run()
    {
        Publication::factory()
            ->count(20)
            ->create();
    }
}
