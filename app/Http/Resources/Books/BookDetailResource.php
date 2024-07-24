<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'book_id' => $this->book_id,
            'book_file' => asset($this->book),
            'name' => $this->name,
            'writer' => $this->writer,
            'cover' => asset($this->cover),
            'summary' => $this->summary,
            'lang' => $this->lang,
            'pages' => $this->pages_num,
            'genre' => $this->shelves->pluck('genre'),
            'published_at' => $this->published_at,
            'readers_num' => $this->num_of_readers,
            'rate' => $this->stars,
            'average_read_time' => $this->avg_read_time,
            'voters_num' => $this->num_of_voters,
            'type' => $this->is_novel,
            'locked?' => $this->is_locked,
            'points' => $this->points,
            'created_at' => $this->created_at,
        ];
    }
}
