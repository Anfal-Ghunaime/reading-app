<?php

namespace App\Actions\Books;

use App\Models\Cafes\Book;


class GetBookFileAction
{
    public function getBook($book_id)
    {
        $book = Book::query()->where('id', $book_id)->first();

        // تأكد من وجود الملف قبل المحاولة
        if (!file_exists(public_path($book->book))) {
            return response()->json(['error' => 'ملف PDF غير موجود'], 404);
        }

        // افتح ملف PDF للقراءة
        $file = fopen(public_path($book->book), 'rb');

        // قم بقراءة المحتوى
        $contents = fread($file, filesize(public_path($book->book)));
        fclose($file);

        $contents = mb_convert_encoding($contents, 'UTF-8', 'ISO-8859-1');  //  استبدل  'ISO-8859-1'  بترميز ملف PDF  اذا لزم الأمر

//  إرجاع الاستجابة
        return response()->make($contents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($book->book) . '"',
        ]);
    }

}
