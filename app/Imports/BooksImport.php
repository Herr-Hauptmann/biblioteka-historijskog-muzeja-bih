<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'id' => $row[0],
            'signature' =>$row[1],
            // 'authors' =>$row[2],
            'title' =>$row[3],
            // 'publishing' =>$row[4],
            // 'keywords' =>$row[5],
            'inventory_number' => $row[6],
        ]);
    }
}
