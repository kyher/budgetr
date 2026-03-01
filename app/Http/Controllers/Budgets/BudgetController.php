<?php

namespace App\Http\Controllers\Budgets;

use App\Actions\CreateBudget;
use App\Http\Controllers\Controller;
use App\Http\Requests\Budgets\StoreBudgetRequest;
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

    public function store(StoreBudgetRequest $request, CreateBudget $createBudget)
    {
        $budget = $createBudget(Auth::user(), $request->validated());

        return redirect()->route('budgets.show', $budget);
    }

    public function remove(Budget $budget)
    {
        if (Auth::id() != $budget->user_id) {
            abort(403);
        }
        $budget->delete();
        return redirect()->route('dashboard');
    }
}
