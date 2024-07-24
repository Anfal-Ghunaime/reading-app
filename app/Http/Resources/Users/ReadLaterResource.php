<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Books\BookDetailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadLaterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'priority' => $this->resource['priority'],
            BookDetailResource::make($this->resource['list'])->toArray($request),
        ];
    }
}
