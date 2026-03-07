<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'amount' => [
                'label' => $this->getAmountLabelAttribute(),
                'value' => $this->amount
            ],
            'remaining' => [
                'label' => $this->getRemainingLabelAttribute(),
                'value' => $this->remaining
            ],
            'paid_at' => $this->paid_at ? $this->paid_at->format('Y-m-d H:i') : null,
        ];
    }
}
