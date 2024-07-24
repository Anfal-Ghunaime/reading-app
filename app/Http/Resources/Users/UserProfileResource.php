<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Books\ShelfResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'profile_id' => $this->id,
            'name' => $this->users->name,
            'email' => $this->users->email,
            'photo' => asset($this->profile_photo),
            'my_points' => $this->my_points,
            'fav_genres' => ShelfResource::collection($this->shelves)
        ];
    }
}
