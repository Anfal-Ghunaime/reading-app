<?php

namespace App\Models\Users;

use App\Models\Communications\ContactUs;
use App\Models\Communications\Inquiry;
use App\Models\Thoughts\Feedback;
use App\Models\Thoughts\Rating;
use App\Models\UserCafe\BookHistory;
use App\Models\UserCafe\Favourite;
use App\Models\UserCafe\ReadingList;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
    ];

    //relations functions
    public function profiles(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
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

    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function contactUs(): HasMany
    {
        return $this->hasMany(ContactUs::class);
    }

//    public function bookHistories(): HasMany
//    {
//        return $this->hasMany(BookHistory::class);
//    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
