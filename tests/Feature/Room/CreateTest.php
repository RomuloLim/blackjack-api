<?php

namespace Tests\Feature\Room;

use App\Enums\RoomStatus;
use App\Models\Room;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    public function it_should_allow_an_authenticated_user_can_create_a_room(): void
    {
        $this->withoutExceptionHandling();

        $roomData = Room::factory()->raw();

        $user = User::factory()->create()->givePermissionTo('create_room');

        Sanctum::actingAs($user);

        $response = $this->postJson(route('room.create'), $roomData);

        $this->assertDatabaseHas(Room::class, [
            ...$roomData,
            'status' => RoomStatus::AwaitingPlayers,
            'user_id' => $user->id,
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function it_should_forbid_an_unauthenticated_user_can_create_a_room()
    {
        $roomData = Room::factory()->raw();
        $response = $this->postJson(route('room.create'), $roomData);

        $response->assertUnauthorized();
        $this->assertDatabaseEmpty(Room::class);
    }

    /** @test */
    public function it_should_to_forbid_an_user_without_role_can_create_a_room()
    {
        $roomData = Room::factory()->raw();

        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson(route('room.create'), $roomData);

        $response->assertForbidden();
        $this->assertDatabaseEmpty(Room::class);
    }

    /** @test */
    public function it_should_fail_validation_when_creating_room_without_name(): void
    {
        $roomData = Room::factory()->raw([
            'name' => null,
        ]);

        $user = User::factory()->create()->givePermissionTo('create_room');

        Sanctum::actingAs($user);

        $response = $this->postJson(route('room.create'), $roomData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('name');

        $this->assertDatabaseEmpty(Room::class);
    }

    /** @test */
    public function it_should_fail_validation_when_creating_with_duplicated_name_and_not_finished_status()
    {
        $roomData = Room::factory()->raw();

        $user = User::factory()->create()->givePermissionTo('create_room');

        Sanctum::actingAs($user);

        $this->postJson(route(('room.create'), $roomData));

        $secondRequest = $this->postJson(route('room.create'), $roomData);

        $secondRequest->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $secondRequest->assertJsonValidationErrors('name');
        $secondRequest->assertJson(fn (AssertableJson $json) => $json->hasAll(['message', 'errors'])
            ->where('message', 'The name has already been taken.')
            ->etc()
        );

        $this->assertDatabaseCount(Room::class, 1);
    }
}
