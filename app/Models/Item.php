<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function getAmountLabelAttribute(): string
    {
        return Number::currency($this->attributes['amount'], 'GBP');
    }

    public function getRemainingLabelAttribute(): string
    {
        return Number::currency($this->attributes['remaining'], 'GBP');
    }
}
