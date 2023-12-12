<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'deck_id' => $this->deck_id,
            'max_players' => $this->max_players,
            'min_players' => $this->min_players,
            'status' => $this->status,
            'user_id',
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
