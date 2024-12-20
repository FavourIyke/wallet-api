<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WalletType>
 */

class WalletTypeFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'minimum_balance' => $this->faker->randomFloat(2, 0, 100),
            'monthly_interest_rate' => $this->faker->randomFloat(2, 0, 5),
        ];
    }
}


