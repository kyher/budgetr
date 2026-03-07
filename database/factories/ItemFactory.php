<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        $amount = fake()->randomFloat(2, 1, 1000);
        return [
            'name' => fake()->word(),
            'amount' => $amount,
            'remaining' => $amount,
            'paid_at' => fake()->boolean() ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'budget_id' => Budget::factory(),
        ];
    }
}
