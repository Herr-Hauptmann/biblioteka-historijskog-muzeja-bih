<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        $this->call([
            AuthorSeeder::class,
            KeywordSeeder::class,
            // //Very important for book seeder to be after keyword and author seeder
            BookSeeder::class,
            PublicationSeeder::class,
            NewsSeeder::class
        ]);

    }
}
