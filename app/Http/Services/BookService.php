<?php

namespace App\Http\Services;
use Illuminate\Validation\Rules;

use App\Http\Services\AuthorService;

use App\Models\Author;
use App\Models\Book;
use App\Models\Keyword;

class BookService{
    //Function that scores how similar the two books are
    //Points for each of the same authors and each same keyword
    //Points for same release year, publisher and place published
    private function score(Book $book, $relatedBooks){
        $authors = $book->authors;
        $keywords = $book->keywords;
        foreach($relatedBooks as $related)
        {
            $related['points'] = 0;
            $relatedAuthors = $related->authors;
            $relatedKeywords = $related->keywords;
            $related->points += $this->countSameIds($relatedAuthors, $authors);
            $related->points += $this->countSameIds($relatedKeywords, $keywords);
            
            if ($book->publisher == $related->publisher)
                $related->points++;
            if ($book->location_published == $related->location_published)
                $related->points++;
            if ($book->year_published == $related->year_published)
                $related->points++;
            $bothBooks = [$book, $related];
        }

        
        usort($relatedBooks, fn($a, $b) => $a->points < $b->points);
    }

    

    private function countSameIds($firstArray, $secondArray){
        $counter = 0;
        foreach($firstArray as $firstItem)
        {
            foreach($secondArray as $secondItem)
            {
                if ($firstItem['id'] == $secondItem['id'])
                    $counter++;
            }
        }
        return $counter;
    }

    private function containsBook($bookId, $bookArray){
        foreach($bookArray as $book)
        {
            if ($book['id'] == $bookId)
                return true;
        }
        return false;
    }

    public function getRelated($bookId){
        $book = Book::findOrFail($bookId);
        
        //Books from same authors
        $authors = $book->authors()->get();
        $relatedBooks = [];
        foreach($authors as $author)
        {
            $authorBooks = $author->books()->get();
            foreach($authorBooks as $bookFromAuthor)
                if ($bookFromAuthor['id'] != $bookId && !$this->containsBook($bookFromAuthor['id'], $relatedBooks))
                    array_push($relatedBooks, $bookFromAuthor);
        }

        //Books with same keywords
        $keywords = $book->keywords()->get();
        foreach($keywords as $keyword)
        {
            $keywordBooks = $keyword->books()->get();
            foreach($keywordBooks as $bookWithKeyword)
                if ($bookWithKeyword['id'] != $bookId && !$this->containsBook($bookWithKeyword['id'], $relatedBooks))
                    array_push($relatedBooks, $bookWithKeyword);
        }

        $this->score($book, $relatedBooks);
        $relatedBooks = array_slice($relatedBooks, 0, 4);
        return $this->makeReadable($relatedBooks);
    }

    private function makeReadable($books)
    {
        $authorService = new AuthorService();
        foreach($books as $book)
        {
            $book["readableAuthors"] = $authorService->listAuthors($book->authors);
            unset($book["authors"]);
            unset($book['year_published']);
            unset($book['publisher']);
            unset($book['location_published']);
            unset($book['inventory_number']);
            unset($book['signature']);
            unset($book['number_of_units']);
            unset($book['keywords']);
            unset($book['created_at']);
            unset($book['updated_at']);
            unset($book['points']);
        }
        return $books;
    }
}