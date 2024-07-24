<?php

namespace App\Actions\ContactUs;

use App\Models\Communications\ContactUs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ReplyAction
{
    public function reply($contact_id, $reply): Model|Builder|string
    {
        $contact = ContactUs::query()->where('id', $contact_id)->first();
        if(!$contact){
            abort(404, 'this message did not exist anymore');
        }
        $contact->update([
            'reply' => $reply,
            'replied_by' => auth()->user()->name,
        ]);
        return 'replied successfully';
    }
}
