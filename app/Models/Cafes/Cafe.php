<?php

namespace App\Models\Cafes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cafe extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shelves(): HasMany
    {
        return $this->hasMany(Shelf::class);
    }
}
