<?php

namespace App\Models\Users;

use App\Models\Cafes\Shelf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shelves(): MorphToMany
    {
        return $this->morphToMany(Shelf::class, 'relatable', 'with_shelves');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
