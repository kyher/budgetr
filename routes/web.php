<?php

use App\Http\Controllers\Budgets\BudgetController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('budgets/{budget}', [BudgetController::class, 'show'])->name('budgets.show');
    Route::post('budgets/{budget}/items', [BudgetController::class, 'addItem'])->name('budgets.items.add');
    Route::delete('budgets/{budget}/items/{item}', [BudgetController::class, 'removeItem'])->name('budgets.items.remove');
    Route::patch('budgets/{budget}/items/{item}/toggle-completion', [BudgetController::class, 'toggleItemCompletion'])->name('budgets.items.toggle-completion');
});

require __DIR__ . '/settings.php';
