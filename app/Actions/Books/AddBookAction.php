<?php

namespace App\Actions\Books;

use App\Models\Cafes\Book;
use App\Models\Cafes\Shelf;
use App\Models\Users\BookRequest;
use App\Services\FilesHandling\FileSaveService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AddBookAction
{
    public function addNewBook(
        $bookFile,
        string $name,
        string $writer,
        $cover,
        string $summary,
        string $lang,
        int $pages,
        string $published_at,
        bool $is_novel,
        array $genres,
        bool $locked = false,
        float $points = 0,
        bool $approved = false): Model|Builder
    {
        $saveService = new FileSaveService();
        if ($cover != null){
            $cover = $saveService->fileSave($cover, 'covers');
        }
        $book = new Book();
        $bookFile = $saveService->fileSave($bookFile, 'books');
        $book = Book::query()->create([
            'book_id' => $book->randVal(),
            'book' => $bookFile,
            'name' => $name,
            'writer' => $writer,
            'cover' => $cover,
            'summary' => $summary,
            'lang' => $lang,
            'pages_num' => $pages,
            'published_at' => $published_at,
            'is_novel' => $is_novel,
            'is_locked' => $locked,
            'points' => $points,
            'approved' => $approved
        ]);
        foreach ($genres as $genre){
            $shelf = Shelf::query()->where('genre', $genre)->first();
            if ($shelf){
                $book->shelves()->attach($shelf['id']);
            }
        }
        if (!$approved){
            BookRequest::query()->create([
                'user_id' => auth()->user()->id,
                'book_id' => $book->id,
                'status' => 'being_reviewed'
            ]);
        }
        return $book;
    }
}
