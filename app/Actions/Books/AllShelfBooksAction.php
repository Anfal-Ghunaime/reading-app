<?php

namespace App\Actions\Books;

use App\Http\Controllers\Cafes\BookController;
use App\Models\Cafes\Book;
use App\Models\Cafes\Shelf;

class AllShelfBooksAction
{
    public function allShelfBooks($shelf_id): array
    {
        $shelf = Shelf::query()->find($shelf_id);
        if(!$shelf){
            abort(404 , 'genre not found!');
        }
//        $books = $shelf->with('books')->get();
        $books = Book::query()->whereHas('shelves', function ($query) use ($shelf_id) {
            $query->where('shelf_id', $shelf_id);
        })->get();
        $list = [];
        $controller = new BookController();
        foreach ($books as $book){
            $list[] = $controller->bookDetails($book->id);
        }
        return $list;
    }
}
