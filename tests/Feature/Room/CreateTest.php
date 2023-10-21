<?php

namespace Tests\Feature\Room;

use App\Enums\RoomStatus;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_user_can_create_a_room(): void
    {
        $this->withExceptionHandling();

        $user = User::factory()->create();

        $user->assignRole('dealer');

        $roomData = Room::factory()->raw();

        $response = $this->actingAs($user)->postJson(route('room.create'), $roomData);

        $this->assertDatabaseHas('rooms', [
            ...$roomData,
            'status' => RoomStatus::AwaitingPlayers,
            'deck_id',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
