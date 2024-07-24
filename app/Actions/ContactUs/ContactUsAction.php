<?php

namespace App\Actions\ContactUs;

use App\Models\Communications\ContactUs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ContactUsAction
{
    public function contactUs($message): Model|Builder
    {
        return ContactUs::query()->create([
            'user_id' => auth()->user()->id,
            'message' => $message,
        ]);
    }
}
