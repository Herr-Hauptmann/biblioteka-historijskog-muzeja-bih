<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Vite;


use App\Models\Book;
use App\Models\Author;
use App\Models\Keyword;

class HomeController extends Controller
{
    public function index(){
        return Inertia::render('Home',
            [
                'background_photo_url' => asset('images/background.jpg'),
                'recaptcha_site_key' => env('GOOGLE_RECAPTCHA_SITE_KEY'),
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
            'photo1_url' => asset('images/slika1-min.jpg'),
            'photo2_url' => asset('images/slika2-min.jpg'),
            'photo3_url' => asset('images/slika3-min.jpg'),
            'photo4_url' => asset('images/slika4-min.jpg'),
            'photo5_url' => asset('images/slika5-min.jpg'),
            'photo6_url' => asset('images/slika6-min.jpg'),
            'photo7_url' => asset('images/slika7-min.jpg'),
        ]);
    }

    public function faq(){
        return Inertia::render('Faq',[
            'photo_url' => asset('images/slika1-min.jpg'),
        ]);
    }
    
    public function contact(){
        return Inertia::render('Contact');
    }
}
