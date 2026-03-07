<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Number;

class Budget extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    protected function getTotalAttribute(): string
    {
        return Number::currency($this->items()->sum('amount'), 'GBP');
    }

    protected function getRemainingAttribute(): string
    {
        return Number::currency($this->items()->where('paid_at', null)->sum('remaining'), 'GBP');
    }
}
