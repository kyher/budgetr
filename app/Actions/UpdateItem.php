<?php

namespace App\Actions;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class UpdateItem
{
    public function __invoke(Item $item, array $data)
    {
        DB::transaction(function () use ($item, $data) {
            $item->name = $data['name'];
            $item->amount = $data['amount'];
            $item->remaining = $data['remaining'];
            $item->save();
        });
    }
}
