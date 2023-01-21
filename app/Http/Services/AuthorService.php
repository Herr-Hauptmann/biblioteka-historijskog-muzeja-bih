<?php

namespace App\Http\Services;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Validation\Rules;

class AuthorService{
    public function createAuthor($name){
        $author = new Author();
        $author->name = $name;
        $author->save();
        return $author;
    }
    
    public function createAuthorsFromArray($newAuthors, $existingAuthors){
        $ids = [];
        foreach($newAuthors as $author){
            $newAuthor = $this->createAuthor($author);
            array_push($ids, $newAuthor->id);
        }

        $ids = array_merge
        (
            $ids, 
            array_map 
            (
                function ($author) 
                {
                    return $author["id"];
                }, 
                $existingAuthors
            )
        );

        return $ids;
    }

    public function addAuthorsToBook($authorIds, Book $book){
        $book->authors()->attach($authorIds);
    }
    
    public function updateBookAuthors($authorIds, Book $book){
        $book->authors()->sync($authorIds);
    }

    public function listAuthors($authors){
        $output = "";
        foreach($authors as $author){
            $output.="".$author->name.", ";
        }
        return substr($output, 0, -2);
    }



}