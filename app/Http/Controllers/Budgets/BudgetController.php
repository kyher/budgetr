<?php

namespace App\Http\Controllers\Budgets;

use App\Http\Controllers\Controller;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function show(Budget $budget)
    {
        if (Auth::id() != $budget->user_id) {
            abort(403);
        }
        $budget = BudgetResource::make($budget);
        return inertia('budgets/Budget', [
            'budget' => $budget
        ]);
    }
}
