<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperRoomPlayer
 */
class RoomPlayer extends Pivot
{
    use HasFactory;

    protected $table = 'room_players';

    protected $fillable = [
        'room_id',
        'user_id',
        'cards',
        'is_owner',
        'online',
    ];
}
