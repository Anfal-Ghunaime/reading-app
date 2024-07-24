<?php

namespace App\Actions\Users;

use App\Models\Cafes\Book;
use App\Models\UserCafe\BookHistory;
use App\Models\UserCafe\ReadingList;
use App\Models\UserCafe\ReadLater;
use Laravel\Prompts\Progress;

class AddToReadHistoryAction
{
    public function addToReadHistory($book_id, $total_time, $date): string
    {
        $book = Book::query()->find($book_id);
        if(!$book){
            abort(404, 'book not exist');
        }
        if(BookHistory::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first())
        {
            return 'book already exist in read history';
        }
        $readLater = ReadLater::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        $readLater?->delete();
        $readNow = ReadingList::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)
            ->where('is_reading', true)
            ->first();
        $readNow?->update(['is_reading' => false]);
        BookHistory::query()->create([
            'book_id' => $book_id,
            'user_id' => auth()->user()->id,
            'finished_at' => $date,
            'total_read_time' => $total_time
        ]);
        return 'added to read history successfully';
    }
}
