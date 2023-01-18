<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

use App\Models\Book;
use App\Models\Author;
use App\Models\Keyword;

use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;

class BookController extends Controller
{
    public function index(Request $request, AuthorService $authorService){
        return Inertia::render('Books/BooksIndex',[
            'books' => Book::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('writer', 'like', '%'.$search.'%')
                    ->orWhere('year_published', '=', $search );
                })
                ->with('authors')
                ->paginate(20)
                ->withQueryString()
                ->through(fn($book)=>[
                    'id' => $book->id,
                    'title' => $book->title,
                    'year_published' => $book->year_published,
                    'author' => $authorService->listAuthors($book->authors),
                    'inventory_number' => $book->inventory_number,
                    ]),
            'filters' => $request->only(['search']),
        ]);

    }

    public function create(){
        return Inertia::render('Books/BooksCreate',[
            'authors' => Author::orderBy('name')->get()->map(fn($author)=>[
                'id' => $author->id,
                'name' => $author->name,
            ]),
            'keywords' => Keyword::orderBy('title')->get()->map(fn($keyword)=>[
                'id' => $keyword->id,
                'name' => $keyword->title,
            ]),
        ]);
    }

    public function store(Request $request, AuthorService $authorService, KeywordService $keywordService){               
        $validatedRequest = $request->validate([
            "title" => "required|unique:books|max:255",
            "year_published" => "required|integer|min:1500|max:".date('Y'),
            "inventory_number" => "required|integer|min:0|unique:books",
            "signature" => "required|string|unique:books|max:255",
            "number_of_units" => "required|integer|min:0",
            "publisher" => "required|string|max:255",
            "location_published" => "required|string|max:255",
            "authors" => "required_without:newAuthors|array",
            "authors.*.id" => "integer|distinct|exists:authors,id",
            "authors.*.name" => "string|distinct|max:255|exists:authors,name",
            "newAuthors" => "required_without:authors|array",
            "newAuthors.*.name" => "string|distinct|unique:authors,name|max:255",
            "keywords" => "required_without:newKeywords|array",
            "keywords.*.id" => "integer|distinct|exists:keywords,id",
            "keywords.*.name" => "string|distinct|max:255|exists:keywords,title",
            "newKeywords" => "required_without:keywords|array",
            "newKeywords.*.name" => "string|distinct|unique:keywords,title|max:255",
        ]);
        $authorIds = $authorService->createAuthorsFromArray($request->newAuthors, $validatedRequest["authors"]);
        $keywordIds = $keywordService->createKeywordsFromArray($request->newKeywords, $validatedRequest["keywords"]);
        unset($validatedRequest["keywords"]);
        unset($validatedRequest["newKeywords"]);
        unset($validatedRequest["authors"]);
        unset($validatedRequest["newAuthors"]);
        $book = Book::create($validatedRequest);
        $authorService->addAuthorsToBook($authorIds, $book);
        $keywordService->addKeywordsToBook($keywordIds, $book);
        return redirect(route("books.index"));
    }
}