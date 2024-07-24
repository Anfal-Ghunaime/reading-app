<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Books\BookDetailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_read_time' => $this->resource['time'],
            'finish_date' => $this->resource['date'],
            BookDetailResource::make($this->resource['list'])->toArray($request),
        ];
    }
}
