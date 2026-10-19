<?php

namespace Database\Factories;

use App\Models\Amout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Amout>
 */
class AmoutFactory extends Factory
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
            'amout' => rand(5,100),
        ];
    }
}
