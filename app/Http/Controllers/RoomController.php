<?php

namespace App\Http\Controllers;

use App\Enums\RoomStatus;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
    public function store(CreateRoomRequest $request): JsonResource
    {
        $data = $request->validated();

        $room = Room::create([
            ...$data,
            'user_id' => auth()->id(),
            'status' => RoomStatus::AwaitingPlayers,
        ]);

        return new RoomResource($room);
    }

    public function joinRoom(Room $room)
    {
        $userAlreadyJoined = $room->players()->where('user_id', auth()->id())->exists();

        if ($userAlreadyJoined) {
            throw ValidationException::withMessages([
                'user_id' => 'User already joined in this room.',
            ]);
        }

        $room->players()->attach(auth()->id(), [
            'cards' => null,
            'is_owner' => false,
            'online' => true,
        ]);

        return new RoomResource($room->loadCount([
            'players' => fn ($query) => $query->where('online', true),
        ]));
    }
}
