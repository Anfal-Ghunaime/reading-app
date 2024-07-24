<?php

namespace App\Services\QuotesHandling;

use App\Http\Resources\Users\QuoteBookDetailsResource;
use App\Http\Resources\Users\QuoteDetailsResource;
use App\Models\Cafes\Book;

class QuoteResponseService
{
    public function quoteResponse($quote){
        if ($quote->source_id){
            $book = Book::query()->where('book_id', $quote->source_id)->first();
            return (new QuoteBookDetailsResource(['quote' => $quote, 'book' => $book]))->resolve();
        } else {
            return (new QuoteDetailsResource($quote))->resolve();
        }
    }
}
