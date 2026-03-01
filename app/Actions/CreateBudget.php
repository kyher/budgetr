<?php

namespace App\Actions;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateBudget
{
    public function __invoke(User $user, array $data)
    {
        return DB::transaction(function () use ($user, $data) {
            $budget = new Budget();
            $budget->name = $data['name'];
            $budget->user_id = $user->id;
            $budget->save();

            return $budget;
        });
    }
}
