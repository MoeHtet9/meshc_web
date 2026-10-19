<?php

namespace Database\Factories;

use App\Models\Holiding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Holiding>
 */
class HolidingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1,10),
            'coin_id' => rand(1,5),
            'amout' => rand(5,100),
            'times' => rand(5,30),
        ];
    }
}
