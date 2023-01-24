<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Author;
use App\Models\Keyword;


class HomeController extends Controller
{
    public function index(){
        return Inertia::render('Home',
            [
                'background_photo_url' => Vite::asset('resources/images/background.jpg')
            ]
        );
    }

    public function dashboard(){
        return Inertia::render('Dashboard', [
            'count' => [
                'books' => Book::count(),
                'authors' => Author::count(),
                'keywords' => Keyword::count(),
            ],
        ]);
    }

    public function about(){
        return Inertia::render('About',[

        ]);
    }
}
