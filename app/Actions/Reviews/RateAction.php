<?php

namespace App\Actions\Reviews;

use App\Models\Cafes\Book;
use App\Models\Thoughts\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class RateAction
{
    public function rate(
        int $book_id,
        $stars): Model|Builder|null
    {
        $rating = Rating::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        if(!$rating){
            $rating = Rating::query()->create([
                'book_id' => $book_id,
                'user_id' => auth()->user()->id,
                'stars' => $stars
            ]);
        }
        $rating->update(['stars' => $stars]);

        $book = Book::query()->where('id', $book_id)->first();
        $book_ratings = $book->ratings()->get();
        $total_rate = 0;
        $count = 0;
        foreach ($book_ratings as $book_rating){
            $total_rate += $book_rating->stars;
            $count += 1;
        }
        $total_rate = $total_rate/$count;
        $book->update(['stars' => $total_rate,
            'num_of_voters' => $count]);
        return $book;
    }
}
