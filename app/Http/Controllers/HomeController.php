<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Proxy;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $count_order = Order::where('user_id', auth()->user()->id)->count();
        $count_trans = Transaction::where('user_id', auth()->user()->id)->where('status', 'success')->sum('amount');

        $query = Order::with(['user', 'proxy']);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        $orders = $query->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(15);


        foreach ($orders as $order) {
            $order->type = 3;
            if ($order->payload) {
                $payload = json_decode($order->payload);
                if (!empty(json_decode($order->payload, true)['Data'])) {
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

        $data = Proxy::where('status', 1)
            ->where('api_id', 1)
            ->get()
            ->groupBy('proxy_type');

        $arr = [];

        foreach ($data as $key => $value) {
            $data_v = Proxy::where('proxy_type', $key)
                ->where('status', 1)
                ->get()
                ->groupBy('use_time_min');

            $firstRecord = Proxy::where('proxy_type', $key)
                ->where('status', 1)
                ->orderBy('use_time_min') // nếu muốn ưu tiên theo min time
                ->first();
            // $firstRecords = $data_v->map->first();
            // dd($data_v, $firstRecord);
            $arr[$key] = [
                'data' => $data_v,
                'name' => $firstRecord
            ];
        }

        $data_2 = Proxy::where('status', 1)
            ->where('api_id', 2)
            ->get()
            ->groupBy('proxy_type');
        // dd($data_2);
        return view('home', compact('orders', 'count_order', 'count_trans', 'arr', 'data_2'));
    }

    public function my_orders(Request $request)
    {

        // Order::where('id', 5)->update([
        //     "end_date" => "2025-09-09",
        // ]);

        $count_order = Order::where('user_id', auth()->user()->id)->count();
        $count_trans = Transaction::where('user_id', auth()->user()->id)->where('status', 'success')->sum('amount');

        $query = Order::with(['user', 'proxy' => function ($q) {
            $q->with(['api_call']);
        }]);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        $orders = $query->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(15);
        foreach ($orders as $order) {
            $order->type = 3;
            if ($order->payload) {
                $payload = json_decode($order->payload);
                if (!empty(json_decode($order->payload, true)['Data'])) {
                    $order->type = 1;
                    $order->payload_data = json_decode($order->payload, true)['Data'] ?? [];
                } else {
                    // dd(json_decode($order->payload, true)['products'][0]);
                    try {
                        $order->type = 2;
                        $payload = json_decode($order->payload, true)['products'] ?? [];
                        $id = $payload[0]['order']['id'] ?? 0;
                        // dd(json_decode($order->payload, true), $id);

                        $response = Http::withToken($order->proxy->api_call->token) // ở đây author chính là token
                            ->get('https://api.homeproxy.vn/api/merchant/proxies?filter=orderId:$eq:string:' . $id);

                        // dd($order->proxy->api_call, 'https://api.homeproxy.vn/api/merchant/proxies?filter=orderId:$eq:string:' . $id, $response->json());
                        $response_data = $response->json();
                        $order->payload_data = [];
                        if ($response->failed()) {
                            // $value->price = 0;
                            $order->payload_data = [];
                        } else {
                            $arr = [];
                            // dd($response_data, $id);
                            $arr_data = $response_data['data'][0];
                            // dd($arr_data, $response_data['data'][0]);

                            $arr['id'] = $arr_data['orderId'];
                            $arr['proxy_type'] = $arr_data['proxy']['ipaddress']['provider'];
                            $arr['public_origin_ip'] = $arr_data['proxy']['ipaddress']['ip'];
                            $arr['prevIp'] = $arr_data['proxy']['ipaddress']['prevIp'];
                            $arr['domain'] = $arr_data['proxy']['ipaddress']['domain'];
                            $arr['port'] = $arr_data['proxy']['port'];
                            $arr['password'] = $arr_data['proxy']['password'];
                            $arr['username'] = $arr_data['proxy']['username'];
                            $order->payload_data = [$arr];
                            // dd($order->payload_data);
                            // $order->payload = json_encode([$arr]);
                            // Order::find($order->id)->update([
                            //     'payload' => json_encode([$arr])
                            // ]);
                            // $order->save();
                        }
                    } catch (Exception $e) {
                        // dd($e);
                    }
                }
            }
            if (empty($order->end_date)) {
                $order->status = 0;
            } else {
                $order->end_date = Carbon::parse($order->end_date)->startOfDay()->format('d-m-Y');
                if (Carbon::parse($order->end_date)->startOfDay()->lt(Carbon::now()->startOfDay())) {
                    $order->status = 0;
                } else {
                    $order->status = 1;
                }
            }
        }

        // dd($orders);
        return view('shop.my_orders', compact('orders', 'count_order'));
    }

    public function xoay($id)
    {
        $data = Order::with(['user', 'proxy' => function ($q) {
            $q->with(['api_call']);
        }])->where('id', $id)->first();



        if (empty($data)) {
            return redirect()->back()->with('error', 'Lỗi');
        } else {
            if (Carbon::parse($data->end_date)->startOfDay()->lt(Carbon::now()->startOfDay())) {
                return redirect()->back()->with('error', 'Proxy hết hạn không thể xoay');
            }
            // dd($data);
            if ($data->proxy->api_id == 1) {
                if (!empty($data->payload)) {
                    $payload = json_decode($data->payload)->Data[0];
                    // dd($payload->package_api_key );
                    $response = Http::withToken($data->proxy->api_call->token) // ở đây author chính là token
                        ->get("https://api.m2proxy.com/user/package/changeip?package_api_key=" . $payload->package_api_key);

                    // dd($response->json());

                    return redirect()->back()->with('success', 'Xoay ip thành công');
                }
            } else {
                if (!empty($data->payload)) {
                    // $payload = json_decode($data->payload);
                    // dd($payload, $payload->products[0]->product->merchant->id);
                    $payload = json_decode($data->payload, true)['products'] ?? [];
                        $id = $payload[0]['order']['id'] ?? 0;
                    $response = Http::withToken($data->proxy->api_call->token) // ở đây author chính là token
                            ->get('https://api.homeproxy.vn/api/merchant/proxies?filter=orderId:$eq:string:' . $id);

                            // dd($data->proxy->api_call, 'https://api.homeproxy.vn/api/merchant/proxies?filter=orderId:$eq:string:' . $id, $response->json());
                        $response_data = $response->json();
                        //  $response_data = $response->json();
                        $arr_data = $response_data['data'][0];
                        // $public_origin_ip = $arr_data['proxy']['ipaddress']['ip'];
                        $public_origin_ip = $arr_data['id'];

                    $response1 = Http::withToken($data->proxy->api_call->token) // ở đây author chính là token
                        ->get("https://api.homeproxy.vn/api/merchant/proxies/$public_origin_ip/rotate");

                    // dd("https://api.homeproxy.vn/api/merchant/proxies/$public_origin_ip/rotate", $response1->json());

                    return redirect()->back()->with('success', 'Xoay ip thành công');
                }
            }
        }

        // dd($orders);
        return redirect()->back()->with('error', 'Lỗi xoay thất bại');
    }

    public function update(Request $request, $id)
    {
        $data = Order::with(['user', 'proxy' => function ($q) {
            $q->with(['api_call']);
        }])->where('id', $id)->first();

        $ip = $request->ip_address;
        $username = $request->username;
        $password = $request->password;
        $time = $request->time;

        if ($request->auth_type == "ip") {
            $data_ip = "IP_ADDRESS";
        } else {
            $data_ip = "USER_PASS";
        }

        if (empty($data)) {
            return redirect()->back()->with('error', 'Lỗi');
        } else {
            if (Carbon::parse($data->end_date)->startOfDay()->lt(Carbon::now()->startOfDay())) {
                return redirect()->back()->with('error', 'Proxy hết hạn không thể cập nhật');
            }
            if (!empty($data->payload)) {
                $payload = json_decode($data->payload)->Data[0];
                // dd($payload->package_api_key );

                $package_api_key = $payload->package_api_key;
                $response = Http::withToken($data->proxy->api_call->token) // ở đây author chính là token
                    ->get("https://api.m2proxy.com/user/package/edit?package_api_key=$package_api_key&proxy_auth_type=$data_ip&proxy_auth_ip=$ip&proxy_auth_username=$username&proxy_auth_password=$password&auto_changeip_time=$time&auto_renew=false");
                $res = $response->json();

                if ($res['Status'] == 'error') {
                    return redirect()->back()->with('success', 'Proxy hết hạn không thể cập nhật');
                } else {
                }
                // dd($response->json());

                return redirect()->back()->with('success', 'Cập nhật thành công');
            }
        }

        // dd($orders);
        return redirect()->back()->with('error', 'Lỗi xoay thất bại');
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
