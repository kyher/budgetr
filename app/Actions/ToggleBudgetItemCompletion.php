<?php

namespace App\Actions;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ToggleBudgetItemCompletion
{
    public function __invoke(Item $item)
    {
        DB::transaction(function () use ($item) {
            $item->completed = !$item->completed;
            $item->save();
        });
    }
}
