<?php

namespace App\Http\Controllers;

use App\Http\Resources\BudgetResource;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function __invoke()
    {
        $budgets = BudgetResource::collection(Auth::user()->budgets);
        return inertia('Dashboard', [
            'budgets' => $budgets
        ]);
    }
}
