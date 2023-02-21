<?php

namespace App\Imports;

use App\Models\Book;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Book([
            'signature' =>$row['signatura'],
            // 'authors' =>$row[2],
            'title' =>$row['naziv_djela'],
            // 'publishing' =>$row[4],
            // 'keywords' =>$row[5],
            'inventory_number' => $row['inventarni_broj'],
        ]);
    }
}
