<?php

namespace App\Actions\Quotes;

use App\Http\Resources\Users\QuoteBookDetailsResource;
use App\Http\Resources\Users\QuoteDetailsResource;
use App\Models\Cafes\Book;
use App\Models\Thoughts\Quote;
use App\Services\QuotesHandling\QuoteResponseService;

class MyQuotesAction
{
    public function myQL(): array
    {
        $quotes = Quote::query()->where('user_id', auth()->user()->id)->get();
        if (!$quotes){
            abort(404 ,'no quotes yet!..');
        }
        $quotes_list = [];
        $service =  new QuoteResponseService();
        foreach ($quotes as $quote){
            $quotes_list[] = $service->quoteResponse($quote);
        }
        return $quotes_list;
    }
}
