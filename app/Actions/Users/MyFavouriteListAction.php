<?php

namespace App\Actions\Users;

use App\Http\Controllers\Cafes\BookController;
use App\Models\UserCafe\Favourite;

class MyFavouriteListAction
{
    public function myFav(): array
    {
        $favors = Favourite::query()->where('user_id', auth()->user()->id)
            ->pluck('book_id')->toArray();
        $fav_list = [];
        foreach ($favors as $fav){
            $book = new BookController();
            $fav_list[] = $book->bookDetails($fav);
        }
        return $fav_list;
    }
}
