<?php

namespace App\Actions\Quotebooks;

use App\Models\Thoughts\Quotebook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class newQuotebookAction
{
    public function newQuotebook(
        $name,
        $bio,
        $image_name): Model|Builder
    {
        return Quotebook::query()->create([
           'user_id' => auth()->user()->id,
           'name' => $name,
           'bio' => $bio,
           'image_name' => $image_name,
           'year' => Carbon::now()->year,
        ]);
    }
}
