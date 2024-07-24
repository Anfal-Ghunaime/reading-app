<?php

namespace App\Actions\Reviews;

use App\Models\Thoughts\Feedback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class AddFeedbackAction
{
    public function addFeedback(
        int $book_id,
        string $feedback): Model|Builder
    {
        return Feedback::query()->create([
            'book_id' => $book_id,
            'user_id' => auth()->user()->id,
            'feedback' => $feedback,
        ]);
    }
}
