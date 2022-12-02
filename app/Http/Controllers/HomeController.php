<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return Inertia::render('Home',
            [
                'logo_url' => Vite::asset('resources/images/logo-head.png'),
                'full_logo_url' => Vite::asset('resources/images/logo.png'),
                'background_photo_url' => Vite::asset('resources/images/background.jpg')
            ]
        );
    }
}
