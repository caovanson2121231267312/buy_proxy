<?php

namespace App\Http\Controllers;

use App\Console\Commands\TestFun;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        TestFun::CheckTrans();

        $query = Transaction::with('user');
        // ->where('user_id', auth()->user()->id);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->orderBy('id', 'desc')->paginate(15);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function index_my(Request $request)
    {
        $query = Transaction::with('user')->where('user_id', auth()->user()->id);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->orderBy('id', 'desc')->paginate(15);

        return view('shop.transactions.index', compact('transactions'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->only([
            'status', 'note'
        ]));

        return back()->with('success', 'Cập nhật giao dịch thành công');
    }
}
