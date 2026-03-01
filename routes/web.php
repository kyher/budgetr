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
});

require __DIR__ . '/settings.php';
