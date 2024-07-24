<?php

namespace App\Models\Cafes;

use App\Models\Communications\Inquiry;
use App\Models\Thoughts\Feedback;
use App\Models\Thoughts\Rating;
use App\Models\UserCafe\Favourite;
use App\Models\UserCafe\ReadingList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function randVal(): string
    {
        while (true){
            $val = '#'.Str::random(7);
            if (!Book::query()->where('book_id', $val)->exists()){
                return $val;
            }
        }
    }

    public function shelves(): MorphToMany
    {
        return $this->morphToMany(Shelf::class, 'relatable', 'with_shelves');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

//    public function favourites(): HasMany
//    {
//        return $this->hasMany(Favourite::class);
//    }
//
//    public function readingLists(): HasMany
//    {
//        return $this->hasMany(ReadingList::class);
//    }
}
