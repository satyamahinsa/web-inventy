<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:0'
        ]);

        $totalAmount = $request->input('amount');
        
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

        return redirect()->route('order.success', ['order' => $order->id])
        ->with('success', 'Pembayaran berhasil dilakukan.');
    }

    public function success(Order $order)
    {
        return view('cart.payment_success', compact('order'));
    }
}
