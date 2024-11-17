<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
// use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function payment()
    {
        $cart = session('cart');
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong. Silakan pilih produk.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.payment', compact('cart', 'total'));
    }

    // public function processPayment(Request $request)
    // {
    //     $cart = session('cart');
    //     $total = 0;

    //     foreach ($cart as $item) {
    //         $total += $item['price'] * $item['quantity'];
    //     }

    //     // $order = Order::create([
    //     //     'user_id' => Auth::id(),
    //     //     'total_amount' => $total,
    //     //     'status' => 'pending', 
    //     //     'name' => $request->input('name'),      
    //     //     'email' => $request->input('email'),    
    //     //     'phone' => $request->input('phone'),    
    //     //     'address' => $request->input('address') 
    //     // ]);

    //     // // Menyiapkan detail transaksi
    //     // $transactionDetails = [
    //     //     'order_id' => $order->id, // Pastikan menggunakan $order->id yang baru saja dibuat
    //     //     'gross_amount' => $total,
    //     // ];

    //     // // Menyiapkan detail pelanggan
    //     // $customerDetails = [
    //     //     'first_name' => Auth::user()->name,
    //     //     'email' => Auth::user()->email,
    //     //     'phone' => $request->phone,
    //     //     'address' => $request->address,
    //     // ];

    //     // // Menyiapkan data transaksi untuk Midtrans
    //     // $params = [
    //     //     'transaction_details' => $transactionDetails,
    //     //     'customer_details' => $customerDetails,
    //     // ];

    //     // // Set konfigurasi Midtrans
    //     // Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     // Midtrans\Config::$isProduction = false;  // Sandbox mode
    //     // Midtrans\Config::$isSanitized = true;
    //     // Midtrans\Config::$is3ds = true;

    //     // // Dapatkan Snap Token dari Midtrans
    //     // $snapToken = \Midtrans\Snap::getSnapToken($params);

    //     // // Kirimkan Snap Token ke view
    //     return view('cart.payment', compact('snapToken', 'cart', 'total'));
    // }

    public function success()
    {
        return view('cart.success');
    }

    public function failed()
    {
        return view('cart.failed');
    }
}
