<?php

namespace App\Http\Services;
use App\Models\Keyword;
use App\Models\Book;

class KeywordService{
    public function createKeyword($title){
        $keyword = new Keyword();
        $keyword->title = $title;
        $keyword->save();
        return $keyword;
    }
    
    public function createKeywordsFromArray($newKeywords, $existingKeywords){
        $ids = [];
        foreach($newKeywords as $keyword){
            $newKeyword = $this->createKeyword($keyword);
            array_push($ids, $newKeyword->id);
        }

        $ids = array_merge
        (
            $ids, 
            array_map 
            (
                function ($keyword) 
                {
                    return $keyword["id"];
                }, 
                $existingKeywords
            )
        );
        
        return $ids;
    }

    public function addKeywordsToBook($keywordIds, Book $book){
        $book->keywords()->attach($keywordIds);
    }

    public function updateBookKeywords($keywordIds, Book $book){
        $book->keywords()->sync($keywordIds);
    }

    public function listKeywords($keywords){
        $output = "";
        foreach($keywords as $keyword){
            $output.="".$keyword->title.", ";
        }
        return substr($output, 0, -2);
    }
}