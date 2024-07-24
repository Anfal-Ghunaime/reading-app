<?php

namespace App\Actions\Users;

use App\Http\Resources\Users\ReadListResource;
use App\Models\Cafes\Book;
use App\Models\UserCafe\ReadingList;
use App\Services\TimeHandling\TimeDiffSumAvgService;
use Illuminate\Support\Facades\DB;

class MyReadListAction
{
    public function myRL(): array
    {
        //get the id list for last record of each book
        $lastReadsIds = ReadingList::query()->where('user_id', auth()->user()->id)
            ->where('is_reading', true)
            ->select('book_id', DB::raw('MAX(id) as id'))
            ->groupBy('book_id')->pluck('id');

        //get the record of each id from the previous id list
        $lastReadings = ReadingList::query()->whereIn('id', $lastReadsIds)
            ->get(['book_id','current_page']);

        //initialize the service that we'll use to calculate total time for now and the list
        $service  = new TimeDiffSumAvgService();
        $RL_list = [];

        foreach ($lastReadings as $lastReading){
            //get the book details and relations
            $book = Book::with('shelves')
                ->where('id', $lastReading->book_id)->first();

            //get all the reading records for the book to calculate total read time till now
            $readTimes = ReadingList::query()->where('user_id', auth()->user()->id)
                ->where('book_id', $lastReading->book_id)
                ->pluck('read_time')->toArray();

            //calculate read percentage
            $percentage = round(($lastReading->current_page*100)/$book->pages_num, 1);
            $RL_list[] = (new ReadListResource(['book' => $book, 'page' => $lastReading->current_page,
                'time' => $service->calculateSum($readTimes), 'percent' => $percentage]));
        }
        return $RL_list;
    }
}
