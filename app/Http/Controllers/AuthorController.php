<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

use App\Http\Services\BookService;
use App\Http\Services\AuthorService;



class AuthorController extends Controller
{
    private $perPage = 20;

    public function index(Request $request)
    {
        return Inertia::render('Authors/AuthorsIndex',[
            'authors' => Author::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orderBy('name', 'asc')
                ->paginate($this->perPage)
                ->withQueryString()
                ->through(fn($author)=>[
                    'id' => $author->id,
                    'name' => $author->name,
                    ]),
            'filters' => $request->only(['search']),
            'path' => 'authors.index',
        ]);
    }

    public function create()
    {
        return Inertia::render('Authors/AuthorsCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:authors,name|max:255',
        ]);
        $author = Author::create([
            'name' => $request->name,
        ]);
        return redirect()->route('authors.index')->with('message', 'Uspješno ste dodali autora "'.$author->name .'"!' );
    }

    //Returns guest view of books from author
    public function show(Author $author)
    {
        //
    }

    public function edit(Author $author)
    {
        return Inertia::render('Authors/AuthorsEdit',[
            'author' => $author,
        ]);
    }

    
    public function update(Request $request, Author $author)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string|unique:authors,name|max:255',
        ]);
        $author->name = $validatedRequest["name"];
        $author->save();
        return redirect()->route('authors.index')->with('message', 'Uspješno ste izmijenili autora "'.$author->name .'"!' );
    }

    public function destroy(Author $author)
    {
        $authorName = $author->name;
        $author->delete();
        return redirect()->route("authors.index")->with('message', 'Uspješno ste izbrisali autora "'.$authorName .'"!' );
    }

    //Returns admin view of books from author
    public function booksOfAuthor(Request $request, $id, BookService $bookService, AuthorService $authorService)
    {
        $author = Author::with('books.authors')->findOrFail($id);
        $books = $bookService->paginate($bookService->sortByTitle($author->books), $this->perPage, $request->page, $request->search);
        foreach($books as $book)
        {
            $book['author'] = $authorService->listAuthors($book->authors);
            unset($book['authors']);
        }
        return Inertia::render('Books/BooksIndex',
        [
            'books' => $books,
            'path' => 'author.books',
            'filters' => $request->only(['search']),
            'what' => 'autora '.$author->name,
        ]);
    }

}
