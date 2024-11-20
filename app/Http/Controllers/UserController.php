<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{
    public function index()
    {
        // Ambil 5 produk dengan stok paling banyak
        $flashSaleProducts = Product::orderBy('stock', 'desc')
            ->take(10)
            ->get()
            ->map(function ($product) {
                $product->original_price = $product->price + ($product->price * 0.2); // Harga sebelum diskon
                $product->discount = 20; // Diskon 20%
                $product->stock_percentage = min(100, ($product->stock / 100) * 100); // Persentase stok
                return $product;
            });

        return view('dashboard.user', compact('flashSaleProducts'));
    }
}
