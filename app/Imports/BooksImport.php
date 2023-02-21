<?php

namespace App\Imports;

use App\Models\Book;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Http\Services\AuthorService;
use App\Http\Services\KeywordService;

class BooksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $authorService = new AuthorService();
        $kewyordService = new KeywordService();

        $book = new Book([
            'signature' =>$row['signatura'],
            // 'authors' =>$row[2],
            'title' =>$row['naziv_djela'],
            // 'publishing' =>$row[4],
            // 'keywords' =>$row[5],
            'inventory_number' => $row['inventarni_broj'],
        ]);

        $authors = $authorService->separateAuthors($row['pisac']);
        dd($authors);
        return $book;
    }
}
