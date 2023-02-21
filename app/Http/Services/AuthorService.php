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

    public function separateAuthors($authors)
    {
        //' i '
        $authorsArray1 = explode(' i ', $authors);
        //-
        $authorsArray2 = [];
        foreach($authorsArray1 as $authorString)
        {
            $temporaryArray = explode('-', $authorString);
            $temporaryArray = $this->clearWhitespace($temporaryArray);
            $authorsArray2 = array_merge($temporaryArray, $authorsArray2);
        }
        $authorsArray1 = $authorsArray2;
        $authorsArray2=[];
        //,
        foreach($authorsArray1 as $authorString)
        {
            $temporaryArray = explode(',', $authorString);
            $temporaryArray = $this->clearWhitespace($temporaryArray);
            $authorsArray2 = array_merge($temporaryArray, $authorsArray2);
        }
        return $authorsArray2;
    }

    private function clearWhitespace($stringArray){
        $cleared = [];
        foreach($stringArray as $string){
            $string = ltrim($string);
            $string = rtrim($string);
            array_push($cleared, $string);
        }
        return $cleared;
    }

    public function getOrCreateAuthorIDs($authors){
        $authorObjects = [];

        foreach($authors as $authorName)
        {
            $author = Author::where('name', '=', $authorName)->first();
            if ($author == null){
                $author = $this->createAuthor($authorName);
            }
            array_push($authorObjects, $author);
        }
        return $this->createAuthorsFromArray([], $authorObjects);
    }
}