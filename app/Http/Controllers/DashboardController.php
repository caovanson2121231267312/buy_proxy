<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng quan orders
        $month   = Carbon::now()->month;
        $totalOrders   = Order::count();
        $totalRevenue  = Order::sum('total_price');
        $totalRevenue_MONTH   = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)->sum('total_price');
        $activeOrders  = Order::where('end_date', '>', now())->count();
        $expiredOrders = Order::where('end_date', '<', now())->count();
        $tongDoanhThu = Order::selectRaw('SUM(total_price - (total_price * (100 - profit) / 100)) as tong_doanh_thu')->value('tong_doanh_thu');

        $tongDoanhThu_MONTH = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('SUM(total_price - (total_price * (100 - profit) / 100)) as tong_doanh_thu')
            ->value('tong_doanh_thu');


        // Tổng quan transactions
        $totalDeposit  = Transaction::where('type', 'deposit')->where('status','success')->sum('amount');
        $totalWithdraw = Transaction::where('type', 'withdraw')->where('status','success')->sum('amount');
        $pendingTrans  = Transaction::where('status','pending')->count();

        // dd($tongDoanhThu);
        // dd(Order::get()->toArray());

        // Người dùng
        $totalUsers = User::count();
        $totalUsers_MONTH = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)->count();
        $totalUsersprice = User::sum('price');
        $totalUsersprice_MONTH = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)->sum('price');

        // Lấy giao dịch gần đây
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();

        // Lấy order gần đây
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'month',
            'tongDoanhThu_MONTH',
            'totalUsers_MONTH',
            'totalRevenue_MONTH',
            'totalUsersprice_MONTH',
            'totalUsersprice',
            'tongDoanhThu',
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
