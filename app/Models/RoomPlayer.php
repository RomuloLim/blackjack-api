<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
