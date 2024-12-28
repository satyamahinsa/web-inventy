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
        // Ambil transaksi berdasarkan role user, tanpa membuat transaksi baru
        if (Auth::user()->role === 'admin') {
            $transactions = Transaction::with('user', 'order')->get();
        } else {
            $transactions = Transaction::with('user', 'order')->where('user_id', Auth::id())->get();
        }
    
        return view('transactions.index', compact('transactions'));
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
        // Muat transaksi bersama dengan data produk
    $transaction = Transaction::with('products')->findOrFail($id);

    // Kirim data transaksi ke view
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
        // Temukan transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);
    
        // Periksa apakah transaksi memiliki order terkait
        if ($transaction->order) {
            // Hapus order terkait
            $transaction->order->delete();
        }
    
        // Menghapus relasi produk terlebih dahulu (jika ada)
        if ($transaction->products()->exists()) {
            $transaction->products()->detach();
        }
    
        // Hapus transaksi
        $transaction->delete();
    
        // Redirect kembali ke halaman transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaction and related order deleted successfully!');
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

    public function downloadPdf($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.download-pdf', compact('transaction'));
    }
    
}
