<?php

namespace App\Actions\Reviews;

use App\Models\Thoughts\Feedback;

class CheckIfHasLikeAction
{
    public function checkIfHasLike($feedback_id)
    {
        $feedback = Feedback::query()->where('id',$feedback_id)->first();
        if(!$feedback){
            abort(404, 'feedback not found');
        }
        $like = $feedback->likes()->where('user_id', auth()->user()->id)->first();
        if (!$like)
        {
            return 'null';
        }
        return $like->type;
    }
}
