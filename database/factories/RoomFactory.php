<?php

namespace Database\Factories;

use App\Enums\RoomStatus;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roomStatus = RoomStatus::cases();

        return [
            'name' => $this->faker->name,
            'deck_id' => null, // TODO: call decks api to get a deck id
            'max_players' => $this->faker->numberBetween(4, 8),
            'min_players' => $this->faker->numberBetween(2, 3),
            'status' => $roomStatus[array_rand($roomStatus)],
            'user_id' => UserFactory::new(),
        ];
    }

    public function configure(): RoomFactory
    {
        return $this->afterCreating(function (Room $room) {

            $user = User::find($room->user_id);
            $user->assignRole('dealer');

            $room->players()->attach($user->id, [
                'is_owner' => true,
                'online' => true,
            ]);
        });
    }
}
