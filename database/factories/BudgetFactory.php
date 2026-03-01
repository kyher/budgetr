<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    public function definition()
    {
        return [
            'name' => fake()->word(),
            'user_id' => User::factory(),
            'items' => Item::factory()->for($this)->count(3),
        ];
    }
}
