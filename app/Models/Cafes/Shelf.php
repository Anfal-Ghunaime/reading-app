<?php

namespace App\Models\Cafes;

use App\Models\Users\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Shelf extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cafes(): BelongsTo
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }

    public function books(): MorphToMany
    {
        return $this->morphedByMany(Book::class, 'relatable', 'with_shelves');
    }

    public function profiles(): MorphToMany
    {
        return $this->morphedByMany(Profile::class, 'relatable', 'with_shelves');
    }
}
