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
        //Migration should have already created the folder
        //This is to make sure it's empty if migrations weren't rolled back properly
        $files = Storage::disk('local')->allFiles('publications');
        Storage::delete($files);

        //Add a file to the folder
        $path = Storage::putFileAs('publications/', new File('resources/docs/example.pdf'), 'example.pdf');

        //Create all publications (should be linked to the file)
        Publication::factory()
            ->count(20)
            ->create();
    }
}
