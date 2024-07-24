<?php

namespace App\Actions\Reviews;

use App\Models\Thoughts\Feedback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;

class EditDeleteFeedbackAction
{
    public function editOrDeleteFeedback(
        $feedback_id,
        $what_to_do,
        $new_feedback = null): Model|Builder|string|null
    {
        $feedback = Feedback::query()->where('id', $feedback_id)->first();
        if(auth()->user()->id != $feedback->user_id){
            abort(403, 'you are not authorized to do this action');
        }
        if($what_to_do == 'delete'){
            $feedback->delete();
            return 'deleted successfully';
        }
        $feedback->update(['feedback' => $new_feedback]);
        return $feedback;
    }
}
