<?php

namespace Database\Factories;

use App\Enums\WalletStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $walletStatus = WalletStatus::cases();

        return [
            'balance' => $this->faker->randomFloat(2, 0, 100000),
            'status' => $walletStatus[array_rand($walletStatus)],
        ];
    }
}
