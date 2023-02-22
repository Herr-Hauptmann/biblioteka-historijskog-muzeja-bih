<?php

namespace App\Imports;

use App\Models\Book;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;
use App\Http\Services\BookService;

class BooksImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $authorService = new AuthorService();
        $keywordService = new KeywordService();
        $bookService = new BookService();
        foreach ($rows as $row)
        {
            $publishingInfo = $bookService->parsePublishingInfo($row['mjesto_izdavac_godina']);
            $book = Book::create([
                'signature' =>$row['signatura'],
                'title' =>$row['naziv_djela'],
                'publisher' =>$publishingInfo['publisher'],
                'location_published' =>$publishingInfo['location_published'],
                'year_published' =>$publishingInfo['year_published'],
                'inventory_number' => $row['inventarni_broj'],
            ]);
            $authors = $authorService->separateAuthors($row['pisac']);
            $keywords = $keywordService->separateKeywords($row['kljucne_rijeci']);
            $authorIds = $authorService->getOrCreateAuthorIDs($authors);
            $keywordIds = $keywordService->getOrCreateKeywordIDs($keywords);
            $authorService->addAuthorsToBook($authorIds, $book);
            $keywordService->addKeywordsToBook($keywordIds, $book);
        }
    }
}
