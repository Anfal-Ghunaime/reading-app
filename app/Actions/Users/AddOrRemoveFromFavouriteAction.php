<?php

namespace App\Actions\Users;

use App\Models\Cafes\Book;
use App\Models\UserCafe\Favourite;

class AddOrRemoveFromFavouriteAction
{
    public function addToFavourite($book_id): string
    {
        $book = Book::query()->find($book_id);
        if(!$book){
            abort(404, 'book not exist');
        }
        $fav = Favourite::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first();
        if (!$fav){
            $fav = Favourite::query()->create([
                'book_id' => $book_id,
                'user_id' => auth()->user()->id,
            ]);
            return 'book added to favourite successfully';
        }
        $fav->delete();
        return 'book removed from favourite successfully';
    }
}
