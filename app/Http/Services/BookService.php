<?php

namespace App\Http\Services;

use App\Http\Services\AuthorService;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Author;
use App\Models\Book;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;

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

    private function addPointIfContains($bookId, $bookArray){
        foreach($bookArray as $book)
        {
            if ($book->id == $bookId){
                $book->points++;
                return true;
            }
        }
        return false;
    }
    
    public function getRelated(Book $book){       
        $relatedBooks = DB::select("
        WITH keywords AS (
            SELECT k.id, k.title 
            FROM 
            biblioteka.keywords k
            INNER JOIN biblioteka.books_keywords bk ON bk.keyword_id = k.id 
            WHERE bk.book_id = $book->id
         ),
         authors AS (
            SELECT a.id, a.name
            FROM biblioteka.authors a
            INNER JOIN biblioteka.books_authors ba ON ba.author_id = a.id
            WHERE ba.book_id = $book->id
         ),
         other_books_keywords AS (
            SELECT b.id AS book_id, b.title, Count(b.id) AS numberOfAppearances
            FROM keywords k
            INNER JOIN biblioteka.books_keywords bk ON bk.keyword_id = k.id 
            INNER JOIN biblioteka.books b ON b.id = bk.book_id 
            GROUP BY b.id, b.title
          ),
        
          other_books_authors AS (
            SELECT b.id AS book_id, b.title, COUNT(b.id) AS numberOfAppearances
            FROM authors a
            INNER JOIN biblioteka.books_authors ba ON ba.author_id = a.id
            INNER JOIN biblioteka.books b ON b.id = ba.book_id
            GROUP BY b.id, b.title
          )
        
          SELECT *
          FROM 
          other_books_authors ba
          INNER JOIN other_books_keywords bk ON ba.book_id = bk.book_id 
          ORDER BY (ba.numberOfAppearances + bk.numberOfAppearances) DESC
          LIMIT 5;
        ");
        
        $relatedArray =[];
        foreach($relatedBooks as $related){
            if ($related->title != $book->title){
                $found = Book::with('authors')->findOrFail($related->book_id);
                array_push($relatedArray, $found);
            }
        }
        return $this->makeReadable($relatedArray);
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

    public function advancedSearch($query)
    {
        $books = [];
        
        //Add by title
        $byTitle = Book::query()->where('title', 'like', '%'.$query.'%')->get();
        foreach($byTitle as $book)
        {
            $book["points"] = 0;
            array_push($books, $book);
        }
        
        //Add by author
        $byAuthor = Author::query()->where('name', 'like', '%'.$query.'%')->get();
        foreach($byAuthor as $author)
        {
            
            $booksOfAuthor = $author->books;
            foreach($booksOfAuthor as $book)
            {

                if (!$this->addPointIfContains($book->id, $books))
                {
                    $book['points'] = 0;
                    array_push($books, $book);
                }
            }
        }

        //Add by tag
        $byTag = Keyword::query()->where('title', 'like', '%'.$query.'%')->get();
        foreach($byTag as $tag)
        {
            $booksWithTag = $tag->books;
            foreach($booksWithTag as $book)
            {
                if (!$this->addPointIfContains($book->id, $books))
                {
                    $book['points'] = 0;
                    array_push($books, $book);
                }
            }
        }

        $byPublisher = Book::query()->where('publisher', 'like', '%'.$query.'%')->get();
        foreach($byPublisher as $book)
        {
            if (!$this->addPointIfContains($book->id, $books)){
                $book['points'] = 0;
                array_push($books, $book);
            }
        }

        $byPlacePublished = Book::query()->where('location_published', 'like', '%'.$query.'%')->get();
        foreach($byPlacePublished as $book)
        {
            if (!$this->addPointIfContains($book->id, $books)){
                $book['points'] = 0;
                array_push($books, $book);
            }
        }

        usort($books, fn($a, $b) => $a->points < $b->points);
        
        $authorService = new AuthorService();
        foreach($books as $book)
        {
            $book["author"] = $authorService->listAuthors($book->authors);
            unset($book["authors"]);
            unset($book["keywords"]);
            unset($book['inventory_number']);
            unset($book['signature']);
            unset($book['number_of_units']);
        }
        return $books;
    }

    public function paginate($items, $perPage = 5, $page = null, $path, $options = [])
    {
        if($page = null)
            $page = 1;
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginator =  new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        $paginator->withPath($path);
        return $paginator;
    }

    public function sortByTitle($books){
        $sorted = $books->sortBy(function($book)
        {
            return $book->title;
        });
        return $sorted;
    }

    public function getPublishing($book){
        $output = "";
        if ($book->publisher != null)
            $output = $output . $book->publisher . ",";
        if ($book->location_published != null)
            $output = $output . $book->location_published . ",";
        if ($book->year_published != null)
            $output = $output . $book->year_published;
        return $output;
    }

    public function parsePublishingInfo($string){
        $publishingInfo = [
            'location_published' => null,
            'publisher' => null,
            'year_published' => null
        ];
        $infoArray = explode(',', $string);
        $infoArray = $this->clearWhitespace($infoArray);

        switch(sizeof($infoArray))
        {
            case 2: 
            {
                $publishingInfo['location_published'] = $infoArray[0];
                $publishingInfo['year_published'] = $infoArray[1];
            }
            break;
            case 3: 
            {
                $publishingInfo['location_published'] = $infoArray[0];
                $publishingInfo['publisher'] = $infoArray[1];
                $publishingInfo['year_published'] = $infoArray[2];
            }
            break;
        }
        if ($publishingInfo['year_published'] == 0)
            $publishingInfo['year_published'] = null;
        return $publishingInfo;
    }

    private function clearWhitespace($array){
        $cleared = [];
        foreach($array as $string){
            $string = ltrim($string);
            $string = rtrim($string);
            array_push($cleared, $string);
        }
        return $cleared;
    }
}