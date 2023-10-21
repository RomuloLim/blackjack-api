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

    /** @test */
    public function it_should_allow_an_authenticated_user_can_create_a_room(): void
    {
        $this->withoutExceptionHandling();
        $this->seed();

        $user = User::factory()->create()->assignRole('dealer');

        $roomData = Room::factory()->raw();

        $response = $this->actingAs($user)->postJson(route('room.create'), $roomData);

        $this->assertDatabaseHas(Room::class, [
            ...$roomData,
            'status' => RoomStatus::AwaitingPlayers,
            'user_id' => $user->id,
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function it_should_forbid_an_authenticated_user_can_create_a_room()
    {
        $this->withoutExceptionHandling();

        $roomData = Room::factory()->raw();
        $response = $this->postJson(route('room.create'), $roomData);

        dd($response->getContent());

        $response->assertForbidden();
        $this->assertDatabaseEmpty(Room::class);
    }
}
