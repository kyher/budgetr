<?php

namespace App\Actions;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ToggleItemPaid
{
    public function __invoke(Item $item)
    {
        DB::transaction(function () use ($item) {
            $item->paid_at = $item->paid_at ? null : now();
            $item->save();
        });
    }
}
