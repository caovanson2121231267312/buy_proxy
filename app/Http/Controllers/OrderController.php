<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Console\Commands\TestFun;
use App\Models\Order;
use App\Models\Proxy;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Order::with(['user' => function($q) {
            $q->withSum('trans', 'amount');
        },
        'proxy' => function($q) {
            $q->with(['api_call']);
        }]);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")->orWhere('email', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        if ($request->filled('orders')) {
            $query->where('id', str_replace('MD', '', $request->orders));
        }
        // orders
        $orders = $query->orderBy('id', 'desc')->paginate(15);


        foreach ($orders as $order) {
            // $order->expired_date_format = $order->expired_date
            //     ? $order->expired_date->format('d/m/Y H:i')
            //     : null;

            // $order->auto_renew_text = $order->auto_renew ? "Có" : "Không";

            // if ($order->proxy_auth_password) {
            //     $order->proxy_auth_password_hidden = str_repeat('*', strlen($order->proxy_auth_password));
            // }
            $order->type = 3;
            if ($order->payload) {
                $payload = json_decode($order->payload);
                if(!empty(json_decode($order->payload, true)['Data'])) {
                    $order->type = 1;
                    $order->payload_data = json_decode($order->payload, true)['Data'] ?? [];
                } else {
                    // dd(json_decode($order->payload, true)['products'][0]);
                    $order->type = 2;
                    $payload = json_decode($order->payload, true)['products'][0] ?? [];
                    $id = $payload->order->id ?? 0;

                    $response = Http::withToken($order->proxy->api_call->token) // ở đây author chính là token
                        ->post('https://api.homeproxy.vn/api/merchant/proxies?filter=orderId:$eq:string:' . $id);


                    $order->payload_data = [];
                }
            }
        }

        // dd($payload);


        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->only([
            'end_date',
            'quantity',
            'unit_price',
            'total_price',
            'auth_type',
            'ip_address',
            'username',
            'password',
            'auto_renew'
        ]));

        return back()->with('success', 'Cập nhật giao dịch thành công');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'package_id'   => 'required|integer',
                'quantity'     => 'required|integer|min:1',
                'unit_price'   => 'required|numeric|min:0',
                'auth_type'    => 'required|in:ip,userpass',
                'ip_address'   => 'nullable|required_if:auth_type,ip|ip',
                'username'     => 'nullable|required_if:auth_type,userpass|string',
                'password'     => 'nullable|required_if:auth_type,userpass|string',
                'auto_renew'   => 'nullable',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gói chưa cập nhật api!');
        }
        $quantity   = (int) $request->quantity;
        $unitPrice  = (float) $request->unit_price;
        $totalPrice = $quantity * $unitPrice;

        $data_proxy = Proxy::with(['api_call'])->where('id', $request->package_id)->first();
        // dd($data_proxy);
        if (empty($data_proxy) || empty($data_proxy->api_call)) {
            return redirect()->back()->with('error', 'Gói chưa cập nhật api!');
        }

        $user = User::where('id', auth()->user()->id)->first();
        if ($user->price < $totalPrice) {
            return redirect()->back()->with('error', 'Số dư không đủ!');
        }
        // dd(123);

        if ($data_proxy->api_call->id == 1) {
            $query = [
                'token' => $data_proxy->api_call->token,
                'package_code' => $data_proxy->package_code,
                'qty' => $quantity ?? 1,
                'auto_renew' => $request->auto_renew == 0 ? 'false' : 'true',
                // 'time_auto_change_ip' => $request->time_auto_change_ip ?? 180,
                'PROXY_AUTH_TYPE' => $request->proxy_auth_type,
            ];

            if ($request->proxy_auth_type == 'ip') {
                $query['PROXY_AUTH_IP'] = $request->ip_address;
            } elseif ($request->proxy_auth_type == 'userpass') {
                $query['PROXY_AUTH_USER'] = $request->username;
                $query['PROXY_AUTH_PASSWORD'] = $request->password;
            }

            if ($request->proxy_country) {
                $query['PROXY_COUNTRY'] = $request->proxy_country;
            }

            $response = Http::get("https://api.m2proxy.com/user/data/buypackage", $query);

            if ($response->failed()) {
                return redirect()->back()->with(['error' => 'API request failed']);
            }

            $data_res = $response->json();
            // dd($data_res);

            $end_date = Carbon::parse($data_res['Data'][0]['expired_date']);

            $order = Order::create([
                'user_id'  => auth()->id(),
                'proxy_id'  => $request->package_id,
                'quantity'    => $quantity,
                'unit_price'  => $unitPrice,
                'total_price' => $totalPrice,
                'payload' => json_encode($data_res),
                'end_date' => $end_date,
                'auth_type'   => $request->auth_type,
                'ip_address'  => $request->auth_type === 'ip' ? $request->ip_address : null,
                'username'    => $request->auth_type === 'userpass' ? $request->username : null,
                'password'    => $request->auth_type === 'userpass' ? $request->password : null,
                'auto_renew'  => $request->boolean('auto_renew'),
            ]);


            $user->update([
                "price" => $user->price - $totalPrice,
            ]);

            return redirect()->route('my_orders')->with('success', 'Đăng ký gói dịch vụ thành công!');
        } else {
            $request->all();
            // $query = CallApi::where('id', $id)->first();
            $content = json_decode($data_proxy->content);
            if (strlen($request->password) < 9) {
                return redirect()->back()->with(['error' => 'Mật khẩu đủ 9 ký tự']);
            }
            // dd(json_decode($data_proxy->content));
            $data_product = [
                [
                    "rotateInterval" => 0,
                    "quantity" => (int) $request->quantity,
                    "dayOfUse" => (int) $request->dayOfUse,
                    "password" => $request->password,
                    "user" => $request->username,
                    "location" => "HNI",
                    "provider" => $content->provider,
                    "protocolType" => "HTTP",
                    "product" => [
                        "id" => $content->id,
                    ],
                ]
            ];
            $response = Http::withToken($data_proxy->api_call->token) // ở đây author chính là token
                ->post('https://api.homeproxy.vn/api/merchant/orders', [
                    'merchantAmount' => 0,
                    'paymentMethod' => 'WALLET',
                    'products' => $data_product,
                ]);

            if ($response->failed()) {
                // dd(json_decode($data_proxy->content), $request->all(), $data_product, $response->json());
                return redirect()->back()->with(['error' => 'API request failed']);
            }
            // dd(json_decode($data_proxy->content), $request->all(), $data_product, $response->json());
            $order = Order::create([
                'user_id'  => auth()->id(),
                'proxy_id'  => $request->package_id,
                'quantity'    => $quantity,
                'unit_price'  => $unitPrice,
                'total_price' => $totalPrice,
                'payload' => json_encode($response->json()),
                'end_date' => Carbon::now()->addDays((int) $request->dayOfUse),
                'auth_type'   => $request->auth_type,
                'ip_address'  => $request->auth_type === 'ip' ? $request->ip_address : null,
                'username'    => $request->auth_type === 'userpass' ? $request->username : null,
                'password'    => $request->auth_type === 'userpass' ? $request->password : null,
                'auto_renew'  => $request->boolean('auto_renew'),
            ]);
            // dd($response->json());

            // $response = Http::post("https://api.m2proxy.com/api/merchant/transactions", $query);

            return redirect()->route('my_orders')->with('success', 'Đăng ký gói dịch vụ thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
