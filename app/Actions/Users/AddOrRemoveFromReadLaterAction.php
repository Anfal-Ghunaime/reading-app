<?php

namespace App\Actions\Users;

use App\Models\Cafes\Book;
use App\Models\UserCafe\BookHistory;
use App\Models\UserCafe\ReadingList;
use App\Models\UserCafe\ReadLater;

class AddOrRemoveFromReadLaterAction
{
    public function readLater($book_id, $priority): string
    {
        $book = Book::query()->find($book_id);
        if(!$book){
            abort(404, 'book not exist');
        }
        $readLaterBook = ReadLater::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        if ($readLaterBook){
            $readLaterBook->delete();
            return 'book removed from read later list successfully!';
        }
        $history = BookHistory::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        if(!$history){
            $readingNow = ReadingList::query()->where('book_id', $book_id)
                ->where('user_id', auth()->user()->id)
                ->where('is_reading', true)
                ->first();
            if (!$readingNow){
                ReadLater::query()->create([
                    'user_id' => auth()->user()->id,
                    'book_id' => $book_id,
                    'priority' => $priority
                ]);
                return 'added to read later successfully';
            }
            return 'this book is in reading now list!';
        }
        return 'this book is already read!';
    }
}
