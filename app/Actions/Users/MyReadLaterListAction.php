<?php

namespace App\Actions\Users;

use App\Http\Resources\Users\ReadLaterResource;
use App\Models\Cafes\Book;
use App\Models\UserCafe\ReadLater;

class MyReadLaterListAction
{
    public function myRLL($order): array
    {
        $RLs = ReadLater::query()
            ->where('user_id', auth()->user()->id)
            ->get(['book_id', 'priority'])
            ->toArray();
        usort($RLs, function ($a, $b) {
            return $a['priority'] <=> $b['priority'];
        });
        if ($order == 'desc') {
            $RLs = array_reverse($RLs);
        }
        $RL_list = [];
        foreach ($RLs as $Rl) {
            $book = Book::with('shelves')
                ->where('id', $Rl['book_id'])
                ->first();
            $prior = $Rl['priority'];
            $RL_list[] = (new ReadLaterResource(['list' => $book, 'priority' => $prior]))
                ->resolve();
        }
        return $RL_list;
    }

}
