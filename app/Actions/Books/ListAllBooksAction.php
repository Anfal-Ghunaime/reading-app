<?php

namespace App\Actions\Books;

use App\Models\Cafes\Book;
use Illuminate\Database\Eloquent\Collection;

class ListAllBooksAction
{
    public function listAllBooks(): Collection|array
    {
        $books = Book::query()
            ->where('approved', true)
            ->get(['id','name','cover','writer','stars','approved','is_locked','created_at']);
        foreach ($books as $book){
            $book->cover = asset($book->cover);
        }
        return $books;
    }
}
