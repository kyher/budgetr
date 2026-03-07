<?php

namespace App\Http\Controllers\BudgetItems;

use App\Actions\AddBudgetItem;
use App\Actions\ToggleItemPaid;
use App\Actions\UpdateItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Budgets\AddItemRequest;
use App\Http\Requests\Budgets\UpdateItemRequest;
use App\Models\Budget;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class BudgetItemController extends Controller
{
    public function addItem(AddItemRequest $request, Budget $budget, AddBudgetItem $addBudgetItem)
    {
        if (Auth::id() != $budget->user_id) {
            abort(403);
        }

        $addBudgetItem($budget, $request->validated());

        return redirect()->route('budgets.show', $budget);
    }

    public function removeItem(Budget $budget, Item $item)
    {
        if (Auth::id() != $budget->user_id) {
            abort(403);
        }

        $item->delete();

        return redirect()->route('budgets.show', $budget);
    }

    public function toggleItemPaid(Budget $budget, Item $item, ToggleItemPaid $toggleItemPaid)
    {
        if (Auth::id() != $budget->user_id) {
            abort(403);
        }

        $toggleItemPaid($item);

        return redirect()->route('budgets.show', $budget);
    }

    public function updateItem(UpdateItemRequest $request, Budget $budget, Item $item, UpdateItem $updateItem)
    {
        if (Auth::id() != $budget->user_id) {
            abort(403);
        }

        $updateItem($item, $request->validated());

        return redirect()->route('budgets.show', $budget);
    }
}
