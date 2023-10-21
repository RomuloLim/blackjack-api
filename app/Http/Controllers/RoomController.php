<?php

namespace App\Http\Controllers;

use App\Enums\RoomStatus;
use App\Models\Room;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $room = Room::create([
            ...$data,
            'user_id' => auth()->id(),
            'status' => RoomStatus::AwaitingPlayers,
        ]);

        return response()->json($room, Response::HTTP_CREATED);
    }
}
