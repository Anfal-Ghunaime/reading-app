<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Books\BookDetailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'current_page' => $this->resource['page'],
            'read_time_so_far' => $this->resource['time'],
            'percentage' => $this->resource['percent'].'%',
            BookDetailResource::make($this->resource['book'])->toArray($request),
        ];
    }
}
