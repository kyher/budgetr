<?php

namespace App\Http\Controllers\Budgets;

use App\Actions\AddBudgetItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Budgets\AddItemRequest;
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

    public function addItem(AddItemRequest $request, Budget $budget, AddBudgetItem $addBudgetItem)
    {
        if (Auth::id() != $budget->user_id) {
            abort(403);
        }

        $addBudgetItem($budget, $request->validated());

        return redirect()->route('budgets.show', $budget);
    }
}
