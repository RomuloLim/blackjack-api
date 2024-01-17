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
            'id' => $this->id,
            'name' => $this->name,
            'deck_id' => $this->deck_id,
            'max_players' => $this->max_players,
            'min_players' => $this->min_players,
            'status' => $this->status,
            'user_id',
            'players_count' => $this->players_count,
        ];
    }
}
