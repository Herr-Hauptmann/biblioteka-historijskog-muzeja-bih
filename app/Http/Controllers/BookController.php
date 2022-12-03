<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        return Inertia::render('Books/BooksIndex',[
            'logo_url' => Vite::asset('resources/images/logo-head.png'),
            'books' => Book::all(),
        ]);
    }
}
