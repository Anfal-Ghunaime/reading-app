<?php

namespace App\Models\Thoughts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quotebook extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function quotes(): BelongsToMany
    {
        return $this->belongsToMany(Quote::class, 'quotebook_quotes');
    }
}
