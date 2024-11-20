<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DigitalReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('dashboard.user');
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
});


Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif ($user->role === 'user') {
        return redirect()->route('dashboard.user');
    }

    abort(403, 'Unauthorized access');
})->middleware(['auth'])->name('dashboard');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

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

// Route produk
Route::resource('products', ProductController::class);
Route::post('/products/{product}/add-to-cart', [ProductController::class, 'addToCart'])->name('products.addToCart');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Route cart Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Route Pembayaran
Route::get('/cart', [PaymentController::class, 'index'])->name('cart.index');
Route::get('/cart/payment', [PaymentController::class, 'payment'])->name('cart.payment');
Route::get('/cart/payment', [CartController::class, 'showPaymentPage'])->name('cart.payment');
Route::get('/cart/payment/success', [PaymentController::class, 'success'])->name('cart.payment.success');
Route::get('/cart/payment/failed', [PaymentController::class, 'failed'])->name('cart.payment.failed');

//Midtrans Payment
Route::post('processPayment', [OrderController::class, 'processPayment']);
Route::get('/cart/payment', [OrderController::class, 'index']);
Route::get('/cart/payment', [OrderController::class, 'showPaymentPage'])->name('cart.payment');


require __DIR__ . '/auth.php';