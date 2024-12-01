<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();

        foreach ($orders as $order) {
            if (!$order->transaction) {
                Transaction::create([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'name' => $order->name,
                    'email' => $order->email,
                    'phone' => $order->phone,
                    'destination_address' => $order->address,
                    'total_amount' => $order->total_amount,
                    'payment_method' => $order->payment_method,
                    'status' => $order->status,
                ]);
            }
        }

        if (Auth::user()->role === 'admin') {
            $transactions = Transaction::with('user', 'order')->get();
        } else {
            $transactions = Transaction::with('user', 'order')->where('user_id', Auth::id())->get();
        }

        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total_price' => 'required|numeric',
            'address' => 'required',
            'shipping_service' => 'required',
            'products' => 'required|array',
            'quantities' => 'required|array',
        ]);

        $transaction = Transaction::create([
            // 'user_id' => auth()->id(),
            'user_id' => 1,
            'shipping_service' => $validatedData['shipping_service'],
            'total_price' => $validatedData['total_price'],
            'status' => 'pending',
        ]);

        foreach ($validatedData['products'] as $index => $productId) {
            $transaction->products()->attach($productId, ['quantity' => $validatedData['quantities'][$index]]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    public function confirm(Request $request, $id)
    {
        $validatedData = $request->validate([
            'shipping_service' => 'required',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->shipping_service = $validatedData['shipping_service'];
        $transaction->status = 'confirmed';
        $transaction->save();

        return redirect()->route('transactions.add')->with('success', 'Transaction confirmed successfully!');
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'products'])->findOrFail($id);
        return view('transactions.detail', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'string',
            'alamat-tujuan' => 'string',
        ]);

        $transaction = Transaction::findOrFail($id);

        $transaction->status = $validatedData['status'];
        $transaction->destination_address = $validatedData['alamat-tujuan'];

        $transaction->save();

        return redirect()->route('transactions.detail', ['id' => $transaction->id])->with('success', 'Transaction sukses diupdate!');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }

    public function history()
    {
        $userId = 1;
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $userTransactions = $user->transactions;

        if ($userTransactions->isEmpty()) {
            return view('transactions.history', ['userTransactions' => [], 'message' => 'Tidak ada transaksi.']);
        }

        return view('transactions.history', compact('userTransactions'));
    }

    public function invoice($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.invoice', compact('transaction'));
    }
}
