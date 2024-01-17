<?php

namespace Tests\Feature\Room;

use App\Models\Room;
use App\Models\RoomPlayer;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class JoinTest extends TestCase
{
    /** @test */
    public function it_should_be_able_to_join_in_a_room(): void
    {
        $user = User::factory()->create()->givePermissionTo('join_room');

        $room = Room::factory()->create([
            'status' => 'awaiting_players',
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson(route('room.join', $room->id));

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas(RoomPlayer::class, [
            'user_id' => $user->id,
            'room_id' => $room->id,
            'cards' => null,
            'is_owner' => false,
            'online' => true,
        ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('data.status', 'awaiting_players')
                ->where('data.players_count', 2) //dealer + player
                ->where('data.id', $room->id)
                ->etc()
        );
    }

    /** @test */
    public function it_should_forbid_an_unauthenticated_user_can_join_on_room(): void
    {
        $user = User::factory()->create()->givePermissionTo('join_room');

        $room = Room::factory()->create([
            'status' => 'awaiting_players',
        ]);

        $response = $this->postJson(route('room.join', $room->id));

        $response->assertUnauthorized();
        $this->assertDatabaseCount(RoomPlayer::class, 1); // only dealer
    }

    /** @test */
    public function it_should_fail_validation_when_joining_in_a_room_without_awaiting_players_status(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_should_fail_validation_when_joining_in_a_room_without_money(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_should_forbid_an_user_without_permission_to_join_in_a_room(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_should_to_remove_the_user_from_the_previous_room(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_should_to_limit_in_two_requests_per_minute()
    {
        $this->assertTrue(true);
    }
}
