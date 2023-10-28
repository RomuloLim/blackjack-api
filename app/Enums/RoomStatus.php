<?php

namespace App\Enums;

enum RoomStatus: string
{
    case AwaitingPlayers = 'awaiting_players';
    case InProgress = 'in_progress';
    case Finished = 'finished';
}
