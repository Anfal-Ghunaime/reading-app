<?php

namespace App\Actions\Quotes;

use App\Models\Thoughts\Quote;
use App\Services\FilesHandling\FileDeleteService;
use App\Services\QuotesHandling\FindQuoteAndCheckAuthService;
use Illuminate\Support\Facades\Gate;

class DeleteQuoteAction
{
    public function deleteQuote($quote_id): string
    {
        $service = new FindQuoteAndCheckAuthService();
        $quote = $service->check_Authorization($quote_id);
        if ($quote->image != null){
            $service = new FileDeleteService();
            $service->fileDelete($quote->image);
        }
        $quote->delete();
        return 'success';
    }
}
