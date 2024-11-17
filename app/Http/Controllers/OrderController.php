<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

class OrderController extends Controller
{
    public function index()
    {
        return view('cart.payment');
    }

    public function processPayment(Request $request)
    {
        $cart = session('cart');
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending', 
            'name' => $request->input('name'),      
            'email' => $request->input('email'),    
            'phone' => $request->input('phone'),    
            'address' => $request->input('address') 
        ]);

        // Menyiapkan detail transaksi
        $transactionDetails = [
            'order_id' => $order->id, 
            'gross_amount' => $total,
        ];

        // Menyiapkan detail pelanggan
        $customerDetails = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        // Menyiapkan data transaksi untuk Midtrans
        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        // Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;  
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('cart.payment', compact('snapToken', 'cart', 'total'));
    }

    public function showPaymentPage()
    {
        $cart = session()->get('cart', []);

        // Hitung total keseluruhan
        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }
        
        return view('cart.payment', [
            'cart' => $cart,
            'grandTotal' => $grandTotal
        ]);
}

}