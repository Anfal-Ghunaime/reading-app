<?php

namespace App\Actions\Quotebooks;

use App\Models\Thoughts\Quote;
use App\Models\Thoughts\Quotebook;
use Illuminate\Support\Facades\DB;

class addQuoteToQuotebookAction
{
    public function addQuote(
        $quote_id,
        $quotebook_id)
    {
        $quote = Quote::query()->find($quote_id);
        $quotebook = Quotebook::query()->find($quotebook_id);
        if (!$quote || $quote->user_id != auth()->user()->id ||
            !$quotebook || $quotebook->user_id != auth()->user()->id){
            abort(400 , 'you have provided a wrong data!');
        }
        $quote_quotebook = DB::table('quotebook_quotes')
            ->where('quote_id', $quote_id)
            ->where('quotebook_id', $quotebook_id)
            ->first();
        if ($quote_quotebook){
            return 'this quote is already existed in this quotebook!';
        }
        $quote->quotebooks()->attach($quotebook_id);
        return 'added to quotebook successfully';
    }
}
