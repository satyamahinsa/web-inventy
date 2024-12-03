<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class DigitalReportController extends Controller
{
    public function index()
    {
        $totalTransactions = Transaction::count();
        $totalCustomers = User::count();
        $totalShippingServices = Transaction::select('shipping_service')->distinct()->count();
        $totalSales = Transaction::sum('total_amount');
        $averageOrderValue = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;
        $completedOrders = Transaction::where('status', 'completed')->count();
        $totalCategory = Product::distinct('category_id')->count('category_id');
        $totalProduct = Product::count('id');

        return view('digital-report.index', [
            'totalTransactions' => $totalTransactions,
            'totalCustomers' => $totalCustomers,
            'totalShippingServices' => $totalShippingServices,
            'totalSales' => $totalSales,
            'averageOrderValue' => $averageOrderValue,
            'completedOrders' => $completedOrders,
            'totalCategory' => $totalCategory,
            'totalProduct' => $totalProduct,
        ]);
    }

    public function transaction()
    {
        $transactions = Transaction::with('user')->get();
        return view('digital-report.detail-transaction-report', compact('transactions'));
    }

    public function product()
    {
        $products = Product::all();
        return view('digital-report.detail-product-report', compact('products'));
    }

    public function user()
    {
        $users = User::all()->map(function ($user) {
            $user->total_transactions = Transaction::where('user_id', $user->id)->count();
            $user->total_spent = Transaction::where('user_id', $user->id)->sum('total_amount');
            return $user;
        });

        return view('digital-report.detail-user-report', compact('users'));
    }
}
