<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookRequestDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'request_owner' => $this->resource['user']->name,
            'request_owner_email' => $this->resource['user']->email,
            'book' => new BookDetailResource($this->resource['book']),
        ];
    }
}
