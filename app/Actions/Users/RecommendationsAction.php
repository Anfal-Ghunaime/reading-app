<?php

namespace App\Actions\Users;

use App\Http\Controllers\Cafes\BookController;
use App\Models\UserCafe\BookHistory;
use App\Models\UserCafe\Favourite;
use App\Models\UserCafe\ReadingList;
use App\Models\UserCafe\ReadLater;
use App\Models\Users\Profile;
use Illuminate\Support\Facades\DB;

class RecommendationsAction
{
    public function Recommendations(): array
    {
        $user = auth()->user();
        $profile = Profile::query()->where('user_id', $user->id)->first();
        $shelves = DB::table('with_shelves')->where('relatable_id', $profile->id)
            ->where('relatable_type', get_class($profile))->pluck('shelf_id')->toArray();
        $unique_books = [];
        $recommended_books = [];
        $controller = new BookController();
        foreach ($shelves as $shelf){
            $books = DB::table('with_shelves')->where('shelf_id', $shelf)
                ->where('relatable_type', '=','App\\Models\\Cafes\\Book')
                ->inRandomOrder()
                ->pluck('relatable_id')->take(5)->toArray();
            foreach ($books as $book){
                $is_exist = $this->check($book, $unique_books);
                if ($is_exist == true){
                    for ($i=0 ;$i<=10 ;$i++){
                        $book = DB::table('with_shelves')->where('shelf_id', $shelf)
                            ->where('relatable_type', '=','App\\Models\\Cafes\\Book')
                            ->inRandomOrder()
                            ->pluck('relatable_id')->first();
                        $is_exist = $this->check($book, $unique_books);
                        if ($is_exist == false){
                            break;
                        }
                    }
                }
                $unique_books[] = $book;
            }
        }
        foreach ($unique_books as $unique_book){
            $recommended_books[] = $controller->bookDetails($unique_book);
        }
        return $recommended_books;
    }


    private function check($book, $unique_books): bool
    {
        $is_exist = false;
        if(BookHistory::query()->where('book_id', $book)
            ->where('user_id', auth()->user()->id)->first()){
            $is_exist = true;
        }
        if (ReadingList::query()->where('book_id', $book)
            ->where('user_id', auth()->user()->id)->first()){
            $is_exist = true;
        }
        if (Favourite::query()->where('book_id', $book)
            ->where('user_id', auth()->user()->id)->first()){
            $is_exist = true;
        }
        if (ReadLater::query()->where('book_id', $book)
            ->where('user_id', auth()->user()->id)->first()){
            $is_exist = true;
        }
        if ($unique_books){
            foreach ($unique_books as $unique_book){
                if ($unique_book == $book){
                    $is_exist = true;
                }
            }
        }
        return $is_exist;
    }
}
