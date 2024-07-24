<?php

namespace App\Actions\Users;

use App\Http\Resources\Users\ReadHistoryResource;
use App\Http\Resources\Users\ReadLaterResource;
use App\Models\Cafes\Book;
use App\Models\UserCafe\BookHistory;
use App\Models\UserCafe\ReadLater;

class MyReadHistoryListAction
{
    public function MyRH (): array
    {
        $HRs = BookHistory::query()->where('user_id', auth()->user()->id)
            ->get(['book_id', 'finished_at', 'total_read_time']);
        $HR_list = [];
        foreach ($HRs as $HR){
            $book = Book::with('shelves')
                ->where('id', $HR->book_id)->first();
            $date = $HR->finished_at;
            $total_time = $HR->total_read_time;
            $HR_list[] = (new ReadHistoryResource(['list' => $book, 'time' => $total_time, 'date' => $date]))
                ->resolve();
        }
        return $HR_list;
    }
}
