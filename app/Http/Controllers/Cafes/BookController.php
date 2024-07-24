<?php

namespace App\Http\Controllers\Cafes;

use App\Actions\Books\AddBookAction;
use App\Actions\Books\AllShelfBooksAction;
use App\Actions\Books\BookInUserListAction;
use App\Actions\Books\DeleteBookAction;
use App\Actions\Books\ListAllBooksAction;
use App\Actions\Books\UpdateBookAction;
use App\Actions\BooksRequests\AcceptOrDenyBookAction;
use App\Actions\BooksRequests\ListBookRequestAction;
use App\Actions\Users\RecommendationsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\BooksValidation\AddBookRequest;
use App\Http\Requests\BooksValidation\GenreRequest;
use App\Http\Requests\BooksValidation\UpdateBookRequest;
use App\Http\Resources\Books\BookDetailResource;
use App\Models\Cafes\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    //simply add book by role!
    //if user is adding pend the book till the admin accept it
    public function addBook(AddBookRequest $bookRequest,
                            GenreRequest   $genreRequest,
                            AddBookAction  $action): JsonResponse
    {
        if (auth()->user()->role != 'user'){
            $book = $action->addNewBook($bookRequest->book,$bookRequest->name,$bookRequest->writer,
                $bookRequest->cover,$bookRequest->summary,$bookRequest->lang,$bookRequest->pages,
                $bookRequest->published_at, $bookRequest->is_novel,$genreRequest->genre,
                $bookRequest->locked,$bookRequest->points,1);
        }else{
            $book = $action->addNewBook($bookRequest->book,$bookRequest->name,$bookRequest->writer,
                $bookRequest->cover,$bookRequest->summary,$bookRequest->lang,$bookRequest->pages,$bookRequest->published_at,
                $bookRequest->is_novel,$genreRequest->genre);
        }
        $book['book'] = asset($book['book']);
        $book['cover'] = asset($book['cover']);
        return response()->json($book);
    }

    //update book info (only admin or master admin)
    public function updateBook($book_id,
                               UpdateBookRequest $request,
                               UpdateBookAction $action): JsonResponse
    {
        $has_cover = false;
        $has_book = false;
        if($request->hasFile('book')){
            $has_book = true;
        }
        if ($request->hasFile('cover')){
            $has_cover = true;
        }
        return response()->json($action->updateBook($book_id,$request->validated(),$has_cover,$has_book));
    }

    //delete the book!
    public function deleteBook($book_id,
                               DeleteBookAction $action): JsonResponse
    {
        return response()->json($action->deleteBook($book_id));
    }

    //return the list of approved book that the user can access
    public function listAllBooks(ListAllBooksAction $action): JsonResponse
    {
        return response()->json($action->listAllBooks());
    }

    //get book details by book_id
    public function bookDetails($book_id): array
    {
        return (new BookDetailResource(Book::with('shelves')
            ->where('id', $book_id)->first()))->resolve();;
    }

    //accept or delete book add request (only admins)
    public function editApproved($book_id, $what_to_do,
                                 AcceptOrDenyBookAction $action): JsonResponse
    {
        return response()->json($action->editApproved($book_id, $what_to_do));
    }

    //get all shelve(genre) books
    public function allShelfBooks($shelf_id, AllShelfBooksAction $action): JsonResponse
    {
        return response()->json($action->allShelfBooks($shelf_id));
    }

    public function recommendations(RecommendationsAction $action): JsonResponse
    {
        return response()->json($action->Recommendations());
    }

    public function requestList(ListBookRequestAction $action): JsonResponse
    {
        return response()->json($action->listBooksRequests());
    }

    public function bookInUserLists($book_id , BookInUserListAction $action): JsonResponse
    {
        return response()->json($action->bookLists($book_id));
    }

    public function getBookFile($book_id)
    {
        $book = Book::findOrFail($book_id);
        $book_path = public_path($book->book);

        // تأكد من وجود الملف
        if (!file_exists($book_path)) {
            return response()->json(['error' => 'ملف PDF غير موجود'], 404);
        }

        return response()->file($book_path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($book_path) . '"',
        ]);
    }


//    public function getBookFile ($book_id, GetBookFileAction $action)
//    {
//        $book = Book::query()->where('id', $book_id)->first();
//
//        // تأكد من وجود الملف قبل المحاولة
//        if (!file_exists(public_path($book->book))) {
//            return response()->json(['error' => 'ملف PDF غير موجود'], 404);
//        }
//
//        // افتح ملف PDF للقراءة
//        $file = fopen(public_path($book->book), 'rb');
//
//        // قم بقراءة المحتوى
//        $contents = fread($file, filesize(public_path($book->book)));
//        fclose($file);
//
//        $contents = mb_convert_encoding($contents, 'UTF-8', 'ISO-8859-1');  //  استبدل  'ISO-8859-1'  بترميز ملف PDF  اذا لزم الأمر
//
////  إرجاع الاستجابة
//        return response()->make($contents, 200, [
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' => 'inline; filename="' . basename($book->book) . '"',
//        ]);
////        return response()->json($action->getBook($book_id));
//    }
}
