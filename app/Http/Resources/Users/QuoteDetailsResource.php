<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'quote_id' => $this->id,
            'quote' => $this->quote,
            'source_id' => null,
            'book_title' => null,
            'author' => null,
            'page' => $this->page_num,
            'thoughts' => $this->my_thoughts,
            'image' => asset($this->image),
            'fav?' => $this->in_fav ? 'in_fav' : 'not_fav'
        ];
    }
}
