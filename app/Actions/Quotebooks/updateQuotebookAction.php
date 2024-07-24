<?php

namespace App\Actions\Quotebooks;

use App\Models\Thoughts\Quotebook;

class updateQuotebookAction
{
    public function updateQb($name, $bio, $image_name, $quotebook_id){
        $quotebook = Quotebook::query()->find($quotebook_id);
        if (!$quotebook){
            abort(404 , 'quotebook not existed!');
        }
        if(auth()->user()->id != $quotebook->user_id || $quotebook->name == 'general'){
            abort(403, 'you are not authorized to do this action');
        }
        if ($name){
            $quotebook->name = $name;
        }
        if ($bio){
            $quotebook->bio = $bio;
        }
        if ($image_name){
            $quotebook->image_name = $image_name;
        }
        $quotebook->save();
        return 'updated successfully';
    }
}
