<?php

namespace App\Actions\Quotes;

use App\Http\Resources\Users\QuoteBookDetailsResource;
use App\Http\Resources\Users\QuoteDetailsResource;
use App\Models\Cafes\Book;
use App\Models\Thoughts\Quote;
use App\Models\Thoughts\Quotebook;
use App\Services\FilesHandling\FileSaveService;
use App\Services\QuotesHandling\FindSimilarBookService;
use App\Services\QuotesHandling\QuoteResponseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class AddQuoteAction
{
    public function addQuote(
        string $quote = null,
        string $source_id = null,
        string $book_name = null,
        string $author = null,
        int $page_num = null,
        string $my_thoughts = null,
        $image = null): Model|Builder|array
    {
        $saveService = new FileSaveService();
        $path = null;
        if ($image){
            $path = $saveService->fileSave($image, 'quotes');
        }
        if (! $source_id && $book_name && $author){
            $similarService = new FindSimilarBookService();
            $source_id = $similarService->findSimilar($book_name, $author);
            if (!$source_id) {
                abort(404, 'book not found!');
            }
        }
        $new_quote =  Quote::query()->create([
            'user_id' => auth()->user()->id,
            'quote' => $quote,
            'source_id' => $source_id,
            'page_num' => $page_num,
            'my_thoughts' => $my_thoughts,
            'image' => $path,
        ]);
        $quotebook = Quotebook::query()->where('user_id', auth()->user()->id)
            ->where('name' , 'general')->first();
        $new_quote->quotebooks()->attach($quotebook->id);
        $responseService = new QuoteResponseService();
        return $responseService->quoteResponse($new_quote);
    }
}
