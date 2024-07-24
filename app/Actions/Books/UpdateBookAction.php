<?php

namespace App\Actions\Books;

use App\Models\Cafes\Book;
use App\Services\FilesHandling\FileDeleteService;
use App\Services\FilesHandling\FileSaveService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class UpdateBookAction
{
    public function updateBook(
        int $id,
        array $data,
        bool $has_cover,
        bool $has_book): Model|Builder|string|null
    {
        $deleteService = new FileDeleteService();
        $saveService = new FileSaveService();
        $book = Book::query()->where('id', $id)->first();
        if(!$book){
            abort(404, 'book not exist');
        }
        if ($has_book){
            $deleteService->fileDelete($book['book']);
            $data['book'] = $saveService->fileSave($data['book'],'books');
        }
        if ($has_cover){
            $deleteService->fileDelete($book['cover']);
            $data['cover'] = $saveService->fileSave($data['cover'],'covers');
        }
        $book->update($data);
        return $book;
    }
}
