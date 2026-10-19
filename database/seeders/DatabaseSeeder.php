<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Coin;
use App\Models\Amout;
use App\Models\Holiding;
use App\Models\Deposit;
use App\Models\Withdrawal;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Coin::factory(5)->create();
        Amout::factory(5)->create();
        Holiding::factory(5)->create();
        Deposit::factory(5)->create();
        Withdrawal::factory(5)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
