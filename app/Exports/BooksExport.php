<?php

namespace App\Exports;

use App\Models\Book;
use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;
use App\Http\Services\BookService;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BooksExport implements FromQuery, WithChunkReading, WithHeadings, ShouldAutoSize
{
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
        $authorService = new AuthorService();
        $keywordService = new KeywordService();
        $bookService = new BookService();

        return [
            'id' => $book->id,
            'signature' => $book->signature,
            'authors' => $authorService->listAuthors($book->authors),
            'title' => $book->title,
            'publishing' => $bookService->getPublishing($book),
            'keywords' => $keywordService->listKeywords($book->keywords),
            'inventory_number' => $book->inventory_number,
        ];
    }
}
