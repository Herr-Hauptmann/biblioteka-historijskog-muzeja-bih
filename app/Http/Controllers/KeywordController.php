<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

use App\Models\Keyword;

use App\Http\Services\BookService;
use App\Http\Services\AuthorService;

class KeywordController extends Controller
{
    private $perPage = 20;
    public function index(Request $request)
    {
        return Inertia::render('Keywords/KeywordsIndex',[
            'keywords' => Keyword::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('title', 'like', '%'.$search.'%');
                })
                ->orderBy('title', 'asc')
                ->paginate(20)
                ->withQueryString()
                ->through(fn($keyword)=>[
                    'id' => $keyword->id,
                    'title' => $keyword->title,
                    ]),
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Keywords/KeywordsCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:keywords,title|max:255',
        ]);
        $keyword = Keyword::create([
            'title' => $request->title,
        ]);
        return redirect()->route('keywords.index')->with('message', 'Uspješno ste dodali ključnu riječ "'.$keyword->title .'"!' );
    }

    public function show(Keyword $keyword)
    {
        //
    }

    public function edit(Keyword $keyword)
    {
        return Inertia::render('Keywords/KeywordsEdit',[
            'keyword' => $keyword,
        ]);
    }

    public function update(Request $request, Keyword $keyword)
    {
        $validatedRequest = $request->validate([
            'title' => 'required|string|unique:keywords,title|max:255',
        ]);
        $keyword->title = $validatedRequest["title"];
        $keyword->save();
        return redirect()->route('keywords.index')->with('message', 'Uspješno ste izmijenili ključnu riječ "'.$keyword->title .'"!' );
    }

    public function destroy(Keyword $keyword)
    {
        $keywordTitle = $keyword->title;
        $keyword->delete();
        return redirect()->route("keywords.index")->with('message', 'Uspješno ste izbrisali ključnu riječ "'.$keywordTitle .'"!' );
    }

    public function booksWithKeyword($id, Request $request, AuthorService $authorService, BookService $bookService)
    {
        $path = '/keywords/'.$id.'/books/';
        $keyword = Keyword::with('books.authors')->findOrFail($id);
        $books = $bookService->paginate(
            $bookService->sortByTitle($keyword->books), 
            $this->perPage, 
            $request->page, 
            $path
        );
        foreach($books as $book)
        {
            $book['author'] = $authorService->listAuthors($book->authors);
            unset($book['authors']);
            unset($book["keywords"]);
            unset($book['publisher']);
            unset($book['location_published']);
            unset($book['number_of_units']);
            unset($book['year_published']);
        }
        return Inertia::render('Books/BooksIndex',
        [
            'books' => $books,
            'what' => 's ključnom riječi '.$keyword->title,
        ]);
    }
}
