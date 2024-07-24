<?php

namespace App\Actions\Users;

use App\Models\Cafes\Book;
use App\Models\UserCafe\BookHistory;
use App\Models\UserCafe\ReadingList;
use App\Models\UserCafe\ReadLater;
use App\Services\TimeHandling\TimeDiffSumAvgService;
use Carbon\Carbon;

class ProgressAction
{
    public function progress(
        $book_id,
        $current_page,
        $start_time,
        $end_time): string
    {
        $book = Book::query()->find($book_id);
        if(!$book){
            abort(404, 'book not exist');
        }
        $readLater = ReadLater::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        $readLater?->delete();
        $previous_read = ReadingList::query()->where('user_id', auth()->user()->id)
            ->where('book_id', $book_id)
            ->where('is_reading', true)
            ->latest()->first();
        $service  = new TimeDiffSumAvgService();
        $diff = $service->calculateDiff($start_time, $end_time);
        if($previous_read){
            ReadingList::query()->create([
                'book_id' => $book_id,
                'user_id' => auth()->user()->id,
                'read_pages' => $current_page-$previous_read->current_page,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'current_page' => $current_page,
                'read_time' => $diff,
            ]);
        }else {
            ReadingList::query()->create([
                'book_id' => $book_id,
                'user_id' => auth()->user()->id,
                'read_pages' => $current_page,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'current_page' => $current_page,
                'read_time' => $diff,
            ]);
        }
        if ($current_page >= $book->pages_num){
            BookHistory::query()->create([
                'book_id' => $book_id,
                'user_id' => auth()->user()->id,
                'finished_at' => Carbon::now(),
                'total_read_time' => $service->calculateSum(ReadingList::query()
                    ->where('user_id', auth()->user()->id)
                    ->where('book_id', $book_id)->pluck('read_time')->toArray()),
            ]);
            $book_histories = BookHistory::query()
                ->where('book_id', $book->id)
                ->pluck('total_read_time')->toArray();
            $book->update([
                'avg_read_time' => $service->calculateAvg($book_histories),
                'num_of_readers' => sizeof($book_histories),
            ]);
            ReadingList::query()->where('user_id', auth()->user()->id)
                ->where('book_id', $book_id)
                ->update(['is_reading' => false]);
        }
        return 'ok';
    }
}
