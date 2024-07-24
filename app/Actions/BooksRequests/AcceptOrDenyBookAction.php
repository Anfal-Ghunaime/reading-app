<?php

namespace App\Actions\BooksRequests;

use App\Models\Cafes\Book;
use App\Models\Users\BookRequest;
use Carbon\Carbon;

class AcceptOrDenyBookAction
{
    public function editApproved($book_id, $what_to_do): string
    {
        $book = Book::query()->where('id', $book_id)->first();
        $bookRequest = BookRequest::query()->where('book_id', $book_id)->first();
        if(!$book){
            abort(404, 'book not exist');
        }
        if($book->approved){
            return 'book already approved';
        }
        if($what_to_do == 'accept'){
            $book->approved = true;
            $book->save();
            $bookRequest->status_change_date = Carbon::now();
            $bookRequest->status = 'approved';
            $bookRequest->save();
            return 'book request accepted';
        }
        elseif ($what_to_do == 'notAccepted'){
            $bookRequest->book_name = $book->name;
            $bookRequest->author = $book->writer;
            $bookRequest->status = 'deleted';
            $bookRequest->status_change_date = Carbon::now();
            $bookRequest->save();
            $book->delete();
            return 'book request deleted!';
        }
    }
}
