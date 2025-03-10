<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;
use App\Imports\BooksImport;

use App\Models\Book;
use App\Models\Author;
use App\Models\Keyword;

use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;
use App\Http\Services\BookService;

class BookController extends Controller
{
    private $perPage = 20;

    public function index(Request $request, AuthorService $authorService)
    {
        return Inertia::render('Books/BooksIndex', [
            'books' => Book::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', '%' . $search . '%')
                            ->orWhere('signature', 'like', '%' . $search . '%')
                            ->orWhere('inventory_number', 'like', '%' . $search . '%');
                    });
                })
                ->with('authors')
                ->orderBy('title', 'asc')
                ->paginate($this->perPage)
                ->withQueryString()
                ->through(fn($book) => [
                    'id' => $book->id,
                    'title' => $book->title,
                    'signature' => $book->signature,
                    'author' => $authorService->listAuthors($book->authors),
                    'inventory_number' => $book->inventory_number,
                ]),
            'filters' => $request->only(['search']),
        ]);
    }


    public function list(Request $request, AuthorService $authorService)
    {
        return Inertia::render('Books/BooksList', [
            'books' => Book::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', '%' . $search . '%')
                            ->orWhere('signature', 'like', '%' . $search . '%')
                            ->orWhere('inventory_number', 'like', '%' . $search . '%');
                    });
                })
                ->with('authors')
                ->orderBy('title', 'asc')
                ->paginate(20)
                ->withQueryString()
                ->through(fn($book) => [
                    'id' => $book->id,
                    'title' => $book->title,
                    'year_published' => $book->year_published,
                    'author' => $authorService->listAuthors($book->authors),
                    'publisher' => $book->publisher,
                    'location_published' => $book->location_published,
                ]),
            'filters' => $request->only(['search']),
            'path' => 'books.search',
        ]);
    }
    public function search(Request $request, BookService $bookService)
    {
        $path = '/books/search?search=' . $request->search;
        return Inertia::render('Books/BooksList', [
            'books' => $bookService->paginate($bookService->advancedSearch($request->search), $this->perPage, $request->page, $path),
            'filters' => $request->only(['search']),
            'path' => 'books.search'
        ]);
    }

    public function create()
    {
        return Inertia::render('Books/BooksCreate', [
            'authors' => Author::orderBy('name')->get()->map(fn($author) => [
                'id' => $author->id,
                'name' => $author->name,
            ]),
            'keywords' => Keyword::orderBy('title')->get()->map(fn($keyword) => [
                'id' => $keyword->id,
                'name' => $keyword->title,
            ]),
        ]);
    }

    public function store(Request $request, AuthorService $authorService, KeywordService $keywordService)
    {
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "year_published" => "nullable|integer|min:1800|max:" . date('Y'),
            "inventory_number" => "required|max:255",
            "signature" => "required|string|max:255",
            "number_of_units" => "required|integer|min:0",
            "publisher" => "nullable|string|max:255",
            "location_published" => "nullable|string|max:255",
            "authors" => "array",
            "authors.*.id" => "integer|distinct|exists:authors,id",
            "authors.*.name" => "string|distinct|max:255|exists:authors,name",
            "newAuthors" => "array",
            "newAuthors.*.name" => "string|distinct|unique:authors,name|max:255",
            "keywords" => "required_without:newKeywords|array",
            "keywords.*.id" => "integer|distinct|exists:keywords,id",
            "keywords.*.name" => "string|distinct|max:255|exists:keywords,title",
            "newKeywords" => "required_without:keywords|array",
            "newKeywords.*.name" => "string|distinct|unique:keywords,title|max:255",
        ]);
        //Create new authors and keywords and merge with existing
        $authorIds = $authorService->createAuthorsFromArray($request->newAuthors, $validatedRequest["authors"]);
        $keywordIds = $keywordService->createKeywordsFromArray($request->newKeywords, $validatedRequest["keywords"]);

        //Fields containing author and keyword info are no longer neccessary, remove them
        unset($validatedRequest["keywords"]);
        unset($validatedRequest["newKeywords"]);
        unset($validatedRequest["authors"]);
        unset($validatedRequest["newAuthors"]);

        //Create the book and it's relationship with keywords and authors
        $book = Book::create($validatedRequest);
        $authorService->addAuthorsToBook($authorIds, $book);
        $keywordService->addKeywordsToBook($keywordIds, $book);

        return redirect()->route("books.index")->with('message', 'Uspješno ste kreirali knjigu "' . $book->title . '"!');
    }

    public function show($id, BookService $bookService)
    {
        // Load the book with necessary relationships
        $book = Book::with(['keywords', 'authors'])->findOrFail($id);

        // Get related books using the service
        $related = $bookService->getRelated($book);

        // Render the page with book and related data
        return Inertia::render('Books/BooksShow', [
            'book' => $book,
            'related' => $related,
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Books/BooksEdit', [
            'book' => Book::with('authors')
                ->with('keywords')
                ->findOrFail($id),
            'authors' => Author::orderBy('name')->get()->map(fn($author) => [
                'id' => $author->id,
                'name' => $author->name,
            ]),
            'keywords' => Keyword::orderBy('title')->get()->map(fn($keyword) => [
                'id' => $keyword->id,
                'name' => $keyword->title,
            ]),
        ]);
    }

    public function update(AuthorService $authorService, KeywordService $keywordService, Request $request, Book $book)
    {
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "year_published" => "nullable|integer|min:1500|max:" . date('Y'),
            "inventory_number" => "required|max:255",
            "signature" => "required|string|max:255",
            "number_of_units" => "required|integer|min:0",
            "publisher" => "nullable|string|max:255",
            "location_published" => "nullable|string|max:255",
            "authors" => "array",
            "authors.*.id" => "integer|distinct|exists:authors,id",
            "authors.*.name" => "string|distinct|max:255|exists:authors,name",
            "newAuthors" => "array",
            "newAuthors.*.name" => "string|distinct|unique:authors,name|max:255",
            "keywords" => "required_without:newKeywords|array",
            "keywords.*.id" => "integer|distinct|exists:keywords,id",
            "keywords.*.name" => "string|distinct|max:255|exists:keywords,title",
            "newKeywords" => "required_without:keywords|array",
            "newKeywords.*.name" => "string|distinct|unique:keywords,title|max:255",
        ]);
        //Create new authors and keywords and merge with existing
        $authorIds = $authorService->createAuthorsFromArray($request->newAuthors, $validatedRequest["authors"]);
        $keywordIds = $keywordService->createKeywordsFromArray($request->newKeywords, $validatedRequest["keywords"]);

        $book->title = $validatedRequest["title"];
        $book->year_published = $validatedRequest["year_published"];
        $book->inventory_number = $validatedRequest["inventory_number"];
        $book->signature = $validatedRequest["signature"];
        $book->number_of_units = $validatedRequest["number_of_units"];
        $book->publisher = $validatedRequest["publisher"];
        $book->location_published = $validatedRequest["location_published"];
        $book->save();

        $authorService->updateBookAuthors($authorIds, $book);
        $keywordService->updateBookKeywords($keywordIds, $book);

        return redirect()->route("books.index")->with('message', 'Uspješno ste uredili knjigu "' . $book->title . '"!');
    }

    public function destroy(Book $book)
    {
        $bookName = $book->title;
        $book->delete();
        return redirect()->route("books.index")->with('message', 'Uspješno ste obrisali knjigu "' . $bookName . '"!');
    }

    public function export()
    {
        return Excel::download(new BooksExport, 'books' . date('-Y-m-d-H:i') . '.xlsx');
        // redirect('/dashboard')->with('success', 'Knjige uspješno spašene!');
    }

    public function import(Request $request)
    {
        $validated = $request->validate([
            "sheet" => "required|file|mimes:xlsx",
        ]);

        Excel::import(new BooksImport, request()->file('sheet'));
        return redirect('/dashboard')->with('message', 'Učitavanje podataka uspiješno!');
    }
}
