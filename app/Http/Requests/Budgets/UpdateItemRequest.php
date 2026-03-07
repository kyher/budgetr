<?php

namespace App\Http\Requests\Budgets;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function rules(): array
    {
        $maxRemaining = $this->amount;
        return [
            'amount' => 'required|numeric|min:0',
            'remaining' => 'required|numeric|min:0|max:' . $maxRemaining,
            'name' => 'required|string|min:3|max:255',
        ];
    }
}
