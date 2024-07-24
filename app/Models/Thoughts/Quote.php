<?php

namespace App\Models\Thoughts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quote extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function quotebooks(): BelongsToMany
    {
        return $this->belongsToMany(Quotebook::class, 'quotebook_quotes');
    }
}
