<?php

namespace App\Services\QuotesHandling;

use App\Models\Thoughts\Quote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;

class FindQuoteAndCheckAuthService
{
    public function check_Authorization($quote_id): Model|Builder|null
    {
        $quote = Quote::query()->where('id', $quote_id)
            ->where('user_id', auth()->user()->id)->first();
        if (!$quote){
            abort(404, 'quote not found!..');
        }
        if (!Gate::denies('update', $quote)){
            abort(403, 'you are not authorized to do this action');
        }
        return $quote;
    }
}
