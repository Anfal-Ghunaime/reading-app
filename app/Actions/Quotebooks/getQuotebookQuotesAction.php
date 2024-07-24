<?php

namespace App\Actions\Quotebooks;

use App\Models\Thoughts\Quote;
use App\Models\Thoughts\Quotebook;
use App\Services\QuotesHandling\QuoteResponseService;

class getQuotebookQuotesAction
{
    public function quotebookQuotes($quotebook_id): array
    {
        $quotebook = Quotebook::with('quotes')->find($quotebook_id);
        if ($quotebook->user_id != auth()->user()->id){
            abort(403 , 'you can\'t access this quotebook!');
        }
        $quotes_list = [];
        $quotes = $quotebook->quotes()->get();
        $service =  new QuoteResponseService();
        foreach ($quotes as $quote){
            $quotes_list[] = $service->quoteResponse($quote);
        }
        return $quotes_list;
    }
}
