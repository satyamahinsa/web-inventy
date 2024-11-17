<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalSales = Transaction::sum('total_price');

        $totalTransactions = Transaction::count();

        $totalCustomers = User::where('role', 'user')->count();

        $averageOrderValue = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;

        return view('dashboard.admin', [
            'totalSales' => $totalSales,
            'totalTransactions' => $totalTransactions,
            'totalCustomers' => $totalCustomers,
            'averageOrderValue' => $averageOrderValue,
        ]);
    }
}
