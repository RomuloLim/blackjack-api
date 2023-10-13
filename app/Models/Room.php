<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperRoom
 */
class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'deck_id',
        'max_players',
        'min_players',
        'status',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'room_players', 'room_id', 'user_id')
            ->withPivot('cards', 'is_owner', 'online')
            ->withTimestamps();
    }
}
