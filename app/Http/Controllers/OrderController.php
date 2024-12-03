<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showPaymentPage()
{
    $cart = session()->get('cart', []);
    $grandTotal = 0;
    foreach ($cart as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }

    return view('cart.payment', [
        'cart' => $cart,
        'grandTotal' => $grandTotal
    ]);
}

public function processPayment(Request $request)
{
    // Validasi form
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'address' => 'required|string',
        'payment_method' => 'required|string',
        'amount' => 'required|numeric|min:0'
    ]);

    $cart = session()->get('cart', []);
    $totalAmount = 0;

    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        if ($product) {
            $totalAmount += $product->price * $item['quantity'];
        }
    }

    // Validasi jumlah total pembayaran
    if ($totalAmount != $request->input('amount')) {
        return redirect()->route('cart.index')->withErrors('Total pembayaran tidak valid.');
    }

    // Mengurangi stok produk
    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        $product->decrement('stock', $item['quantity']);
    }

    // Membuat order baru
    $order = Order::create([
        'user_id' => Auth::id(),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'total_amount' => $totalAmount,
        'payment_method' => $request->input('payment_method'),
        'status' => 'pending'
    ]);

    // Menyimpan produk dalam pesanan
    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        $order->products()->attach($product->id, [
            'quantity' => $item['quantity'],
        ]);
    }

    // Membuat transaksi baru setelah order dibuat
    $transaction = Transaction::create([
        'order_id' => $order->id,
        'user_id' => $order->user_id,
        'name' => $order->name,
        'email' => $order->email,
        'phone' => $order->phone,
        'destination_address' => $order->address,
        'total_amount' => $order->total_amount,
        'payment_method' => $order->payment_method,
        'status' => 'pending', // Status awal transaksi
    ]);

    // Menambahkan produk ke transaksi
    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        $transaction->products()->attach($product->id, [
            'quantity' => $item['quantity'],
        ]);
    }

    // Menghapus cart session setelah pembayaran sukses
    session()->forget('cart');

    // Redirect ke halaman sukses pembayaran
    return redirect()->route('order.success', ['order' => $order->id])
        ->with('success', 'Pembayaran berhasil dilakukan.');
}

public function success(Order $order)
{
    // Ambil data cart dari session
    $cart = session()->get('cart', []);
    $products = $order->products;

    // Kirim data order dan cart ke view
    return view('cart.payment_success', compact('order', 'cart', 'products'));
}

}
