<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
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
            'artist' => $this->user_id,
            'name' => $this->name,
            'type' => $this->type,
            'release_date' => $this->release_date,
            'genre' => $this->genre,
            'songs' => SongResource::collection($this->songs),
        ];
    }
}
