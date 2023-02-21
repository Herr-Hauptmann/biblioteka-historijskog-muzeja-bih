<?php

namespace App\Imports;

use App\Models\Book;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;

class BooksImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $authorService = new AuthorService();
        $kewyordService = new KeywordService();
        foreach ($rows as $row)
        {
            $book = Book::create([
                'signature' =>$row['signatura'],
                // 'authors' =>$row[2],
                'title' =>$row['naziv_djela'],
                // 'publishing' =>$row[4],
                // 'keywords' =>$row[5],
                'inventory_number' => $row['inventarni_broj'],
            ]);
            $authors = $authorService->separateAuthors($row['pisac']);
            // $authors = $kewyordService->separateKeywords($row['kljucne_rijeci']);
            $authorIds = $authorService->getOrCreateAuthorIDs($authors);
            $authorService->addAuthorsToBook($authorIds, $book);
        }
    }
}
