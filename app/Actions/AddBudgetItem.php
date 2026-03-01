<?php

namespace App\Actions;

use App\Models\Budget;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class AddBudgetItem
{
    public function __invoke(Budget $budget, array $data)
    {
        DB::transaction(function () use ($budget, $data) {
            $item = new Item();
            $item->name = $data['name'];
            $item->amount = $data['amount'];
            $budget->items()->save($item);
        });
    }
}
