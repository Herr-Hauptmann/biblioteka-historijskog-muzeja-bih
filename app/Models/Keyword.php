<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'title'];

    public function books(){
        return $this->belongsToMany(Book::class, 'books_keywords');
    }
}
