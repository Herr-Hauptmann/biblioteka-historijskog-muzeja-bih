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
            'photo1_url' => Vite::asset('resources/images/slika1-min.jpg'),
            'photo2_url' => Vite::asset('resources/images/slika2-min.jpg'),
            'photo3_url' => Vite::asset('resources/images/slika3-min.jpg'),
            'photo4_url' => Vite::asset('resources/images/slika4-min.jpg'),
            'photo5_url' => Vite::asset('resources/images/slika5-min.jpg'),
            'photo6_url' => Vite::asset('resources/images/slika6-min.jpg'),
            'photo7_url' => Vite::asset('resources/images/slika7-min.jpg'),
        ]);
    }

    public function faq(){
        return Inertia::render('Faq',[
            'photo_url' => Vite::asset('resources/images/slika1-min.jpg'),
        ]);
    }
    
    public function contact(){
        return Inertia::render('Contact');
    }
}
