<?php

namespace App\Services\QuotesHandling;

use App\Models\Cafes\Book;

class FindSimilarBookService
{
    public function findSimilar($book_name, $author){
        $source_id = null;
        $book = Book::query()->where('name', 'LIKE', "%$book_name%")
            ->where('writer', 'LIKE', "%$author%")->first();
        if ($book){
            $source_id = $book->book_id;
        } else {
            $books_list = Book::all();
            foreach ($books_list as $value) {
                similar_text($value->name, $book_name, $percent1);
                similar_text($value->writer, $author, $percent2);
                $percent = ($percent1 + $percent2)/2;
                if ($percent > 80) {
                    $source_id = $value->book_id;
                    break;
                }
            }
        }
        return $source_id;
    }
}
