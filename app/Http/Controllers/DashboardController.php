<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng quan orders
        $totalOrders   = Order::count();
        $totalRevenue  = Order::sum('total_price');
        $activeOrders  = Order::where('end_date', '>', now())->count();
        $expiredOrders = Order::where('end_date', '<', now())->count();

        // Tổng quan transactions
        $totalDeposit  = Transaction::where('type', 'deposit')->where('status','success')->sum('amount');
        $totalWithdraw = Transaction::where('type', 'withdraw')->where('status','success')->sum('amount');
        $pendingTrans  = Transaction::where('status','pending')->count();

        // Người dùng
        $totalUsers = User::count();

        // Lấy giao dịch gần đây
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();

        // Lấy order gần đây
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'activeOrders',
            'expiredOrders',
            'totalDeposit',
            'totalWithdraw',
            'pendingTrans',
            'totalUsers',
            'recentTransactions',
            'recentOrders'
        ));
    }
}
