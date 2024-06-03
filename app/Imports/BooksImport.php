<?php

namespace App\Imports;

use App\Models\Book;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\SimpleExcel\SimpleExcelWriter;

use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;
use App\Http\Services\BookService;

class BooksImport implements ToCollection, WithHeadingRow
{
    protected $errors = [];

    public function collection(Collection $rows)
    {
        $authorService = new AuthorService();
        $keywordService = new KeywordService();
        $bookService = new BookService();
        foreach ($rows as $row)
        {
            try {
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
            } catch (\Exception $e) {
                $rowArray = $row->toArray();
                $rowArray['error'] = $e->getMessage();
                $this->errors[] = $rowArray;
            }
        }

        // Export errors to Excel
        if (!empty($this->errors)) {
            $this->exportErrorsToExcel();
        }
    }

    protected function exportErrorsToExcel()
    {
        $filePath = storage_path('app/errors.xlsx');
        $writer = SimpleExcelWriter::create($filePath);
        foreach ($this->errors as $errorRow) {
            $writer->addRow($errorRow);
        }
        $writer->close();

        return response()->download($filePath, 'errors.xlsx');
    }

}
