<?php

namespace App\Actions\Quotebooks;

use App\Models\Thoughts\Quote;
use App\Models\Thoughts\Quotebook;

class removeFromQuotebookAction
{
    public function removeFromQb(
        $quotebook_id,
        array $ids)
    {
        $quotebook = Quotebook::query()->find($quotebook_id);
        if (!$quotebook){
            abort(404 , 'quotebook not existed!');
        }
        if ($quotebook->name == 'general'){
            abort(403, 'you can\'t update this quotebook');
        }
        foreach ($ids as $id){
            $quote = Quote::query()->find($id);
            if (!$quote || $quote->user_id != auth()->user()->id){
                continue;
            }
            $quotebook->quotes()->detach($id);
        }
        return 0;
    }
}
