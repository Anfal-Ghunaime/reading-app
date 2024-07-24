<?php

namespace App\Actions\Books;

use App\Models\Cafes\Book;
use App\Models\UserCafe\BookHistory;
use App\Models\UserCafe\ReadingList;
use App\Models\UserCafe\ReadLater;

class BookInUserListAction
{
    public function bookLists($book_id): array
    {
        $book = Book::query()->where('id', $book_id)->first();
        if(!$book){
            abort(404, 'book not exist');
        }
        $list = [];
        $readLaterBook = ReadLater::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        $history = BookHistory::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        $readingNow = ReadingList::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        if ($readLaterBook){
            $list[] = 'readLater';
        }
        if ($history){
            $list[] = 'readHistory';
        }
        if ($readingNow){
            $list[] = 'readList';
        }
        return $list;
    }
}
