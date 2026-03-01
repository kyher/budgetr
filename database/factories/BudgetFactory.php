<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Item;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    public function definition()
    {
        return [
            'name' => fake()->word(),
            'user_id' => User::factory()
        ];
    }

    public function configure()
    {
        return parent::configure()
            ->afterCreating(function (Budget $budget) {
                $budget->items()->saveMany(Item::factory()->for($budget)->count(3)->make());
            });
    }
}
