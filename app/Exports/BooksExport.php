<?php

namespace App\Exports;

use App\Models\Book;
use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;
use App\Http\Services\BookService;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BooksExport implements FromQuery, WithChunkReading, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $authorService;
    protected $keywordService;
    protected $bookService;

    public function __construct()
    {
        $this->authorService = new AuthorService();
        $this->keywordService = new KeywordService();
        $this->bookService = new BookService();
    }

    public function query()
    {
        return Book::query()->with('authors', 'keywords');
    }

    public function chunkSize(): int
    {
        return 1000; // Adjust the chunk size as necessary
    }

    public function headings(): array
    {
        return [
            'Redni broj',
            'Signatura',
            'Pisac',
            'Naziv djela',
            'Mjesto, izdavač, godina',
            'Ključne riječi',
            'Inventarni broj',
        ];
    }

    public function map($book): array
    {
        return [
            'redni_broj' => $book->id,
            'signatura' => $book->signature,
            'pisac' => $this->authorService->listAuthors($book->authors),
            'naziv_djela' => $book->title,
            'mjesto_izdavac_godina' => $this->bookService->getPublishing($book),
            'kljucne_rijeci' => $this->keywordService->listKeywords($book->keywords),
            'inventarni_broj' => $book->inventory_number,
        ];
    }
}