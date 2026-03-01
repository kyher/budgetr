<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Budget::factory()->count(1)->create([
            'name' => 'Test Budget',
            'user_id' => $user->getKey()
        ]);
    }
}
