<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Migration should have already created the folder
        //This is to make sure it's empty if migrations weren't rolled back properly
        $files = Storage::disk('local')->allFiles('news');
        Storage::delete($files);

        News::factory()
            ->count(10)
            ->create();
    }
}
