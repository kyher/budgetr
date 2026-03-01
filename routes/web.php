<?php

use App\Http\Controllers\BudgetItems\BudgetItemController;
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
    Route::post('budgets', [BudgetController::class, 'store'])->name('budgets.store');
    Route::delete('budgets/{budget}', [BudgetController::class, 'remove'])->name('budgets.remove');
    Route::post('budgets/{budget}/items', [BudgetItemController::class, 'addItem'])->name('budgets.items.add');
    Route::delete('budgets/{budget}/items/{item}', [BudgetItemController::class, 'removeItem'])->name('budgets.items.remove');
    Route::patch('budgets/{budget}/items/{item}/toggle-completion', [BudgetItemController::class, 'toggleItemCompletion'])->name('budgets.items.toggle-completion');
});

require __DIR__ . '/settings.php';
