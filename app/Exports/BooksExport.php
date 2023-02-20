<?php

namespace App\Exports;

use App\Models\Book;
use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;
use App\Http\Services\BookService;

use Maatwebsite\Excel\Concerns\FromCollection;

class BooksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $authorService = new AuthorService();
        $keywordService = new KeywordService();
        $bookService = new BookService();

        return Book::with('authors')
                ->with('keywords')
                ->get()
                ->map(fn($book)=>[
                    'id' => $book->id,
                    'signature' => $book->signature,
                    'authors' => $authorService->listAuthors($book->authors),
                    'title' => $book->title,
                    'publishing' => $bookService->getPublishing($book),
                    'keywords' => $keywordService->listKeywords($book->keywords),
                    'inventory_number' => $book->inventory_number,
                ]);
    }
}
