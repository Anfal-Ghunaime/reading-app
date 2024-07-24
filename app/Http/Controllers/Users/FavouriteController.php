<?php

namespace App\Http\Controllers\Users;

use App\Actions\Users\AddOrRemoveFromFavouriteAction;
use App\Actions\Users\MyFavouriteListAction;
use App\Http\Controllers\Cafes\BookController;
use App\Http\Controllers\Controller;
use App\Models\UserCafe\Favourite;
use Illuminate\Http\JsonResponse;

class FavouriteController extends Controller
{
    public function addToFav($book_id, AddOrRemoveFromFavouriteAction $action): JsonResponse
    {
        return response()->json($action->addToFavourite($book_id));
    }

    public function checkIfInFav($book_id): string
    {
        $found = "true";
        if (!Favourite::query()->where('book_id', $book_id)
            ->where('user_id', auth()->user()->id)->first())
        {
            $found = "false";
        }
        return $found;
    }

    public function myFavourite(MyFavouriteListAction $action){
        return response()->json($action->myFav());
    }
}
