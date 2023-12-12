<?php

namespace App\Http\Controllers;

use App\Enums\RoomStatus;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;

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
        //
    }
}
