<?php

namespace App\Actions\Books;

use App\Models\Cafes\Book;
use App\Services\FilesHandling\FileDeleteService;

class DeleteBookAction
{
    public function deleteBook(int $id): string
    {
        $service = new FileDeleteService();
        $book = Book::query()->where('id', $id)->first();
        if(!$book){
            abort(404, 'book not exist');
        }
        $service->fileDelete($book['book']);
        $service->fileDelete($book['cover']);
        $book->delete();
        return 'book deleted successfully';
    }
}
