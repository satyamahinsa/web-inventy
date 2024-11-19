<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        // KPI Metrics
        $totalSales = Transaction::sum('total_price');
        $totalTransactions = Transaction::count();
        $totalCustomers = User::where('role', 'user')->count();
        $averageOrderValue = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;

        // Contoh perhitungan profit (misalnya, 70% dari total penjualan adalah profit)
        $profitMargin = 0.7;
        $totalProfit = $totalSales * $profitMargin;

        // Timeseries Data (Transaksi Per Bulan)
        $monthlyTransactions = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];

        $formattedMonthlyTransactions = [];
        foreach ($months as $key => $month) {
            $formattedMonthlyTransactions[] = $monthlyTransactions[$key + 1] ?? 0;
        }

        // Kategori Produk Terlaris
        $categories = Category::pluck('name')->toArray();
        $categorySales = Transaction::join('product_transaction', 'transactions.id', '=', 'product_transaction.transaction_id')
            ->join('products', 'product_transaction.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COALESCE(SUM(product_transaction.quantity), 0) as total_sales')
            ->groupBy('categories.name')
            ->pluck('total_sales', 'categories.name');

        $categorySales = collect($categories)->mapWithKeys(function ($category) use ($categorySales) {
            return [$category => $categorySales[$category] ?? 0];
        });

        $categoryNames = $categorySales->keys()->toArray();
        $categorySalesValues = $categorySales->values()->toArray();

        // Pendapatan per Kategori Produk
        $categoryRevenues = Transaction::join('product_transaction', 'transactions.id', '=', 'product_transaction.transaction_id')
            ->join('products', 'product_transaction.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COALESCE(SUM(product_transaction.quantity * products.price), 0) as total_revenue')
            ->groupBy('categories.name')
            ->pluck('total_revenue', 'categories.name');

        $categoryRevenues = collect($categories)->mapWithKeys(function ($category) use ($categoryRevenues) {
            return [$category => $categoryRevenues[$category] ?? 0];
        });

        $categoryRevenueValues = $categoryRevenues->values()->toArray();

        // Pertumbuhan Pelanggan Baru per Bulan
        $monthlyNewCustomers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('role', 'user')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $formattedMonthlyNewCustomers = [];
        foreach ($months as $key => $month) {
            $formattedMonthlyNewCustomers[] = $monthlyNewCustomers[$key + 1] ?? 0;
        }

        // Recent Transactions Table
        $recentTransactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Top 5 customers by latest transactions
        $latestCustomers = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('user_id')
            ->take(5)
            ->map(function ($transaction) {
                return $transaction->user;
            });

        return view('dashboard.admin', [
            'totalSales' => $totalSales,
            'totalTransactions' => $totalTransactions,
            'totalCustomers' => $totalCustomers,
            'averageOrderValue' => $averageOrderValue,
            'totalProfit' => $totalProfit,
            'months' => $months,
            'monthlyTransactions' => $formattedMonthlyTransactions,
            'categoryNames' => $categoryNames,
            'categorySales' => $categorySalesValues,
            'recentTransactions' => $recentTransactions,
            'latestCustomers' => $latestCustomers,
            'categoryRevenues' => $categoryRevenueValues,
            'monthlyNewCustomers' => $formattedMonthlyNewCustomers,
        ]);
    }
}
