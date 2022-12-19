<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Validation\Rules;

// Ovo izbrisati kasnije
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Books/BooksIndex',[
            'books' => Book::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('writer', 'like', '%'.$search.'%')
                    ->orWhere('year_published', '=', $search );
                })
                ->paginate(20)
                ->withQueryString()
                ->through(fn($book)=>[
                    'id' => $book->id,
                    'title' => $book->title,
                    'year_published' => $book->year_published,
                    'author' => $book->writer,
                    'inventory_number' => Str::random(15),
                    ]),
            'filters' => $request->only(['search']),
        ]);

    }

    public function create(){
        return Inertia::render('Books/BooksCreate',[
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year_published' => 'required|integer|min:1700|max:2100',
        ]);
        $book = Book::create([
            'title' => $request->title,
            'writer' => $request->author,
            'year_published' => $request->year_published
        ]);

        return redirect(route("books.index"));
    }
}
