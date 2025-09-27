<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TradingPlan>
 */
class TradingPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'min_amount' => $this->faker->randomFloat(2, 1000, 10000),
            'max_amount' => $this->faker->randomFloat(2, 10001, 50000),
            'duration' => $this->faker->numberBetween(1, 12),
        ];
    }
}
