<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteBookDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'quote_id' => $this->resource['quote']->id,
            'quote' => $this->resource['quote']->quote,
            'source_id' => $this->resource['quote']->source_id,
            'book_title' => $this->resource['book']->name,
            'author' => $this->resource['book']->writer,
            'page' => $this->resource['quote']->page_num,
            'thoughts' => $this->resource['quote']->my_thoughts,
            'image' => asset($this->resource['quote']->image),
            'fav?' => $this->resource['quote']->in_fav ? 'in_fav' : 'not_fav'
        ];
    }
}
