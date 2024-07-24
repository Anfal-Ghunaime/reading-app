<?php

namespace App\Actions\BooksRequests;

use App\Http\Resources\Books\BookRequestDetailsResource;
use App\Models\Cafes\Book;
use App\Models\Users\BookRequest;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;

class ListBookRequestAction
{
    //إضافة معلومة عن اليوزر اللي طلب إضافة الكتاب ..
    public function listBooksRequests(): Collection|array
    {
        $books = Book::query()
            ->where('approved', false)
            ->get(['id','name','cover','writer','stars','approved','is_locked','created_at']);
        $requestedBooks = [];
        foreach ($books as $book){
            $request = BookRequest::query()->where('book_id', $book->id)->first();
            $user  = User::query()->where('id' , $request->user_id)->first();
            $requestedBooks[] = new BookRequestDetailsResource(['user' => $user , 'book' => $book]);
        }
        return $requestedBooks;
    }
}
