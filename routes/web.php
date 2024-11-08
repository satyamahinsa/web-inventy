<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DigitalReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'rolemanager:user'])->name('user');

// Route::get('/admindashboard', function () {
//     return view('admindashboard');
// })->middleware(['auth', 'verified', 'rolemanager:admin'])->name('admindashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:user'])->name('dashboard');

Route::get('/admindashboard', [TransactionController::class, 'adminDashboard'])
    ->middleware(['auth', 'verified', 'rolemanager:admin'])
    ->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index-admin');

Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');

Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');

Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');

Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.detail');

Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');

Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');

Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

Route::get('/transactions/{id}/invoice', [TransactionController::class, 'invoice'])->name('transactions.invoice');

Route::get('/digital-report', [DigitalReportController::class, 'index'])->name('digital-report.index');

Route::get('/digital-report/detail-transaction-report', [DigitalReportController::class, 'transaction'])->name('digital-report.detail-transaction-report');

Route::get('/digital-report/detail-product-report', [DigitalReportController::class, 'product'])->name('digital-report.detail-product-report');

Route::get('/digital-report/detail-user-report', [DigitalReportController::class, 'user'])->name('digital-report.detail-user-report');

require __DIR__ . '/auth.php';