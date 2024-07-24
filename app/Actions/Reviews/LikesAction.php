<?php

namespace App\Actions\Reviews;

use App\Models\Thoughts\Feedback;
use App\Models\Thoughts\Like;

class LikesAction
{
    public function like($feedback_id, $what_to_do) :string
    {
        $feedback = Feedback::query()->where('id',$feedback_id)->first();
        if(!$feedback){
            abort(404, 'feedback not found');
        }
        $like = $feedback->likes()->where('user_id', auth()->user()->id)->first();
        if (!$like) {
            $like = new Like([
                'user_id' => auth()->user()->id,
                'type' => $what_to_do,
            ]);
            $feedback->likes()->save($like);
            $this->countLikes($feedback);
            return 'ok';
        }
        if ($like->type != $what_to_do){
            $like->delete();
            $like = new Like([
                'user_id' => auth()->user()->id,
                'type' => $what_to_do,
            ]);
            $feedback->likes()->save($like);
            $this->countLikes($feedback);
            return 'ok';
        }
        $like->delete();
        $this->countLikes($feedback);
        return 'like deleted';
    }

    public function countLikes($feedback): void
    {
        $likes = $feedback->likes()->get();
        $likes_count = 0;
        $dislikes_count = 0;
        foreach ($likes as $like) {
            if ($like->type == 'like'){
                $likes_count ++;
            }elseif ($like->type == 'dislike'){
                $dislikes_count++;
            }
        }
        $feedback->update([
            'likes' => $likes_count,
            'dislikes' => $dislikes_count,
        ]);
    }
}
