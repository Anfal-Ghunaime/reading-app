<?php

namespace App\Actions\Quotes;

use App\Http\Resources\Users\QuoteBookDetailsResource;
use App\Http\Resources\Users\QuoteDetailsResource;
use App\Models\Cafes\Book;
use App\Models\Thoughts\Quote;
use App\Services\FilesHandling\FileDeleteService;
use App\Services\FilesHandling\FileSaveService;
use App\Services\QuotesHandling\FindQuoteAndCheckAuthService;
use App\Services\QuotesHandling\FindSimilarBookService;
use App\Services\QuotesHandling\QuoteResponseService;
use Illuminate\Support\Facades\Gate;

class UpdateQuoteAction
{
    public function updateQuote(
               $quote_id,
        string $quote = null,
        string $source_id = null,
        string $book_name = null,
        string $author = null,
        int $page_num = null,
        string $my_thoughts = null,
               $image = null)
    {
        $service = new FindQuoteAndCheckAuthService();
        $quote_to_update = $service->check_Authorization($quote_id);
        if ($quote){
            $quote_to_update->quote = $quote;
        }
        if ($source_id || $book_name && $author){
            $similarService = new FindSimilarBookService();
            $source_id = $similarService->findSimilar($book_name, $author);
            if (!$source_id) {
                abort(404, 'book not found!');
            }
            $quote_to_update->source_id = $source_id;
        }
        if ($page_num){
            $quote_to_update->page_num = $page_num;
        }
        if ($my_thoughts){
            $quote_to_update->my_thoughts = $my_thoughts;
        }
        if ($image){
            $saveService = new FileSaveService();
            $image = $saveService->fileSave($image, 'quotes');
            if ($quote_to_update->image != null){
                $deleteService = new FileDeleteService();
                $deleteService->fileDelete($quote_to_update->image);
            }
            $quote_to_update->image = $image;
        }
        $quote_to_update->save();
        $responseService = new QuoteResponseService();
        return $responseService->quoteResponse($quote_to_update);
    }
}
