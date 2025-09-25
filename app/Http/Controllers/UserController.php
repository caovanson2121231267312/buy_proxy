<?php

namespace App\Http\Controllers;

use App\Console\Commands\TestFun;
use App\Services\VietQrService;
use App\Models\Config;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Support\VietQr;

class UserController extends Controller
{

    protected $vietqr;

    public function __construct(VietQrService $vietqr)
    {
        $this->vietqr = $vietqr;
    }

    /**
     * API tạo VietQR
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'accountNo'   => 'required|string',
            'accountName' => 'required|string',
            'acqId'       => 'required|string', // Mã ngân hàng theo NAPAS (vd: 970415)
            'addInfo'     => 'nullable|string',
            'amount'      => 'nullable|numeric',
            'template'    => 'nullable|string|in:compact,compact2,qr_only,print',
        ]);

        $result = $this->vietqr->generate($validated);

        return response()->json($result);
    }

    public function payment(Request $request)
    {
        TestFun::CheckTrans();

        $user = auth()->user();

        $bank_name      = Config::getValue('bank_name');
        $accountNo   = Config::getValue('bank_acc');       // SỐ TÀI KHOẢN THỤ HƯỞNG
        $accountName = 'Phamhongson99';         // KHÔNG DẤU, VIẾT HOA
        $amount      = 150000;                // 150,000 VND
        $addInfo     = 'DH12345 - THANH TOAN';

        // $qrUrl = VietQr::quickLink($bankId, $accountNo, $accountName, $amount, $addInfo, 'compact2', 'png');
        $result = $this->vietqr->generate([
            "accountNo" => Config::getValue('bank_acc'),
            "accountName" => "Phamhongson99",
            "acqId" => "970416",
            "addInfo" => "BUYPROXY" . $user->id,
            "amount" => "",
            "format" => "text",
            "template" => 'compact'
        ]);

        if (!empty($result["code"]) && $result["code"] == 0) {
            $qr_img = $result["data"]["qrDataURL"];
        } else {
            $qr_img = $result["data"]["qrDataURL"];
        }
        // dd($result);

        return view('shop.user.payment', compact('user', 'result', 'qr_img', 'bank_name', 'accountNo', 'accountName', 'amount', 'addInfo', 'addInfo'));
    }


    public function showToken(Request $request)
    {
        $user = auth()->user();
        return view('shop.user.token', compact('user'));
    }

    public function regenerateToken(Request $request)
    {
        $user = auth()->user();

        // Tạo token mới
        $user->token = hash('sha256', Str::random(60));
        $user->save();

        return redirect()->route('user.token')->with('success', 'Đổi token thành công!');
    }

    public function index(Request $request)
    {
        $query = User::query()->withSum('trans', 'amount');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }
        if ($request->filled('phone')) {
            $phone = $request->phone;
            $query->where('name', $phone);
        }

        $arrange = $request->arrange ?? 1;

        if ($arrange == 1) {
            $users = $query->orderBy('id', 'desc')->paginate($request->show ?? 10);
        } else if ($arrange == 2) {
            $users = $query->orderBy('id', 'asc')->paginate($request->show ?? 10);
        } else if ($arrange == 3) {
            $users = $query->orderBy('price', 'desc')->paginate($request->show ?? 10);
        } else {
            $users = $query->orderBy('trans_sum_amount', 'desc')->paginate($request->show ?? 10);
        }

        $users = $users->appends($request->all());

        // dd($users );
        return view('shop.users.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            // 'phone' => 'required|string|max:255',
            'role' => 'required',
            // 'email' => "required|email|unique:users,email,$id",
        ]);
        // dd($request->all());

        $user->update($request->only('name', 'phone', 'role'));

        return redirect()->route('users.index')->with('success', 'Cập nhật user thành công!');
    }

    public function updateMoney(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            // 'phone' => 'required|string|max:255',
            'price' => 'required',
            // 'email' => "required|email|unique:users,email,$id",
        ]);
        // dd($request->all());
        if ($request->type == 1) {
            if ($user->price < $request->price) {
                return redirect()->route('users.index')->with('error', 'Không thể trừ âm tài khoản!');
            }
            $user->update(
                [
                    'price' => $user->price - $request->price,
                ]
            );

            Transaction::create([
                'user_id' => $user->id,
                'type' => "withdraw",
                'amount' => $request->price,
                'method' => 'admin',
                'status' => 'success',
                'note' => 'Admin trừ tiền ' . auth()->user()->email
            ]);
        } else {
            $user->update(
                [
                    'price' => $user->price + $request->price,
                ]
            );

            Transaction::create([
                'user_id' => $user->id,
                'type' => "deposit",
                'amount' => $request->price,
                'method' => 'admin',
                'status' => 'success',
                'note' => 'Admin cộng tiền ' . auth()->user()->email
            ]);
        }



        return redirect()->route('users.index')->with('success', 'Cập nhật user thành công!');
    }


    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|min:6',
        ]);

        if ($request->password != $request->password_confirmation) {
            return redirect()->route('users.index')->with('error', 'Xác nhận mật khẩu chưa khớp!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Đổi mật khẩu thành công!');
    }
}
