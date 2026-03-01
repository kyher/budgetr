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
        return [
            'name' => fake()->word(),
            'amount' => fake()->randomFloat(2, 1, 1000),
            'budget_id' => Budget::factory(),
        ];
    }
}
