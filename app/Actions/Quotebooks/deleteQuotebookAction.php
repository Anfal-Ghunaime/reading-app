<?php

namespace App\Actions\Quotebooks;

use App\Models\Thoughts\Quotebook;

class deleteQuotebookAction
{
    public function deleteQuotebook($quotebook_id, $what_to_do){
        $quotebook = Quotebook::with('quotes')->find($quotebook_id);
        if (!$quotebook){
            abort(404 , 'quotebook not existed!');
        }
        if(auth()->user()->id != $quotebook->user_id || $quotebook->name == 'general'){
            abort(403, 'you are not authorized to do this action');
        }
        if ($what_to_do == 'all'){
            $quotebook->quotes()->delete();
            $quotebook->delete();
            return 'quotebook with all it\'s quotes deleted successfully!';
        }
        $quotebook->delete();
        return 'quotebook delted successfully!';
    }
}
