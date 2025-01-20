<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    public function run() : void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        $this->call([
            // AuthorSeeder::class,
            // KeywordSeeder::class,
            //Very important for book seeder to be after keyword and author seeder
            // BookSeeder::class,
            // PublicationSeeder::class,
            // NewsSeeder::class
        ]);
    }
}
