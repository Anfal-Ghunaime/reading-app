<?php

namespace App\Actions\Quotes;

use App\Models\Thoughts\Quote;
use App\Services\QuotesHandling\FindQuoteAndCheckAuthService;
use Illuminate\Support\Facades\Gate;

class AddOrRemoveQuoteFromFavAction
{
    public function favOrNot($quote_id): string
    {
        $service = new FindQuoteAndCheckAuthService();
        $quote = $service->check_Authorization($quote_id);
        if ($quote->in_fav == true){
            $quote->in_fav = false;
        }else {
            $quote->in_fav = true;
        }
        $quote->save();
        return 'success';
    }
}
