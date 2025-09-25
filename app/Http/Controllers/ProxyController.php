<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Proxy;
use App\Models\CallApi;
use Illuminate\Http\Request;
use App\Console\Commands\TestFun;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Proxy::with('api_call');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('proxy_type_name', 'like', "%$search%");
        }
        if ($request->filled('package_code')) {
            $package_code = $request->package_code;
            $query->where('package_name', $package_code);
        }

        $data = $query->latest('id')->paginate(10);
        // dd($data);

        return view('admin.proxy.index', compact('data'));
    }

    public function api_index(Request $request)
    {
        $query = CallApi::withCount(['proxy_0', 'proxy_1']);

        // if ($request->filled('search')) {
        //     $search = $request->search;
        //     $query->where('proxy_type_name', 'like', "%$search%");
        // }
        // if ($request->filled('package_code')) {
        //     $package_code = $request->package_code;
        //     $query->where('name', $package_code);
        // }

        $data = $query->paginate(10);

        foreach ($data as $value) {
            $value->price = 0;
            if ($value->id == 1) {
                $response = Http::get('https://api.m2proxy.com/user/data/getuserinfor?token=' . $value->token);

                if ($response->failed()) {
                    $value->price = 0;
                } else {
                    $data_res = $response->json();
                    // dd($data_res['Data'][0]['balance_amount']);
                    $value->price = $data_res['Data'][0]['balance_amount'] ?? 0;
                }
            } else {
                $response = Http::withToken($value->token) // ở đây author chính là token
                    ->get('https://api.homeproxy.vn/api/merchant/merchants');

                if ($response->failed()) {
                    $value->price = 0;
                } else {
                    $data_res = $response->json();
                    // dd($data_res['data'][0]['totalDeposited']);
                    $value->price = $data_res['data'][0]['coin'] ?? 0;
                }
            }


            // dd($value);
        }

        return view('admin.api.index', compact('data'));
    }

    public function extend(Request $request, $id)
    {
        try {
            $order = Order::where("id", $id)->first();
            $payload = json_decode($order->payload);
            // dd($payload->Data[0]->package_api_key);

            $data_proxy = Proxy::with(['api_call'])->where('id', $order->proxy_id)->first();
            if (empty($data_proxy) || empty($data_proxy->api_call)) {
                return redirect()->back()->with('error', 'Gói chưa cập nhật api!');
            }

            $user = User::where('id', auth()->user()->id)->first();
            if ($user->price < $order->total_price) {
                return redirect()->back()->with('error', 'Số dư không đủ!');
            }

            if( $data_proxy->api_call->id == 1) {
                $response = Http::get('https://api.m2proxy.com/user/package/renew?package_api_key=' . $payload->Data[0]->package_api_key);
            }
            // dd('https://api.m2proxy.com/user/package/renew?package_api_key=' . $payload->Data[0]->package_api_key);
            if ($response->failed()) {
                return redirect()->back()->with(['error' => 'API request failed']);
            }
            if($response->json()["Status"] == "error") {
                return redirect()->back()->with(['error' => $response->json()["Message"]]);
            }
            // dd($response->json());

            $data_res = $response->json()['Data'][0]['expired_date'];
            $order->update([
                'end_date' => Carbon::parse($data_res)
            ]);
            $user->update([
                'price' => $user->price - $order->total_price,
            ]);

            return redirect()->back()->with(['success' => 'Gia hạn thành công']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function roundVND($number, $mode = 0)
    {
        // Xác định bậc làm tròn (nghìn)
        $base = 1000;

        switch ($mode) {
            case 0: // giữ nguyên
                return $number;

            case 1: // làm tròn lên
                return ceil($number / $base) * $base;

            case 2: // làm tròn xuống
                return floor($number / $base) * $base;

            default: // mode không hợp lệ -> giữ nguyên
                return $number;
        }
    }

    public function api_run(Request $request, $id)
    {
        try {
            $query = CallApi::where('id', $id)->first();
            if ($query->status == 0) {
                return redirect()->back()->with(['error' => 'API đang tạm ngừng']);
            }
            if ($query->id == 1) {
                $response = Http::get($query->link . $query->token);

                if ($response->failed()) {
                    return redirect()->back()->with(['error' => 'API request failed']);
                }

                $data = $response->json();
                if (!isset($data['Data'])) {
                    return redirect()->back()->with(['error' => 'Invalid API response']);
                }

                foreach ($data['Data'] as $item) {
                    $data_update = [
                        'user_id'     => auth()->user()->id,
                        'api_id'     => $query->id,
                        "price" => $this->roundVND(($item['price'] + ($item['price'] * $query->price_increase) / 100), $query->price_type),
                    ];
                    $check = Proxy::where('package_code', $item['package_code'])->first();

                    if (!empty($check)) {
                        if ($query->content_type == 1) {
                            $data_update['proxy_type'] = $item['proxy_type'] ?? null;
                            $data_update['proxy_type_name'] = $item['proxy_type_name'] ?? null;
                            $data_update['package_code'] = $item['package_code'] ?? null;
                            $data_update['package_name'] = $item['package_name'] ?? null;
                            $data_update['expiry_time'] = $item['expiry_time'] ?? null;
                            $data_update['use_time_min'] = $item['use_time_min'] ?? null;
                            $data_update['status'] = 1;
                            $data_update['content'] = '';
                        }
                        $check->update($data_update);
                    } else {
                        Proxy::updateOrCreate(
                            ['package_code' => $item['package_code']], // điều kiện update
                            [
                                'user_id'     => auth()->user()->id,
                                'api_id'     => $query->id,
                                'proxy_type'     => $item['proxy_type'] ?? null,
                                'proxy_type_name' => $item['proxy_type_name'] ?? null,
                                'package_code'   => $item['package_code'] ?? null,
                                'package_name'   => $item['package_name'] ?? null,
                                'price'          => $this->roundVND(($item['price'] + ($item['price'] * $query->price_increase) / 100), $query->price_type),
                                'expiry_time'    => $item['expiry_time'] ?? null,
                                'use_time_min'   => $item['use_time_min'] ?? null,
                                'status'         => 1,
                                'content'        => '', // lưu raw data
                            ]
                        );
                    }
                }
            } else {
                $response = Http::withToken($query->token) // ở đây author chính là token
                    ->get($query->link);

                if ($response->failed()) {
                    return redirect()->back()->with(['error' => 'API request failed']);
                }

                $data = $response->json();
                // dd($data);

                if (!isset($data['data'])) {
                    return redirect()->back()->with(['error' => 'Invalid API response']);
                }

                foreach ($data['data'] as $item) {
                    $data_update = [
                        'user_id'     => auth()->user()->id,
                        'api_id'     => $query->id,
                        "price" => $this->roundVND(($item['price'] + ($item['price'] * $query->price_increase) / 100), $query->price_type),
                    ];
                    $check = Proxy::where('package_code', $item['id'])->first();

                    if (!empty($check)) {
                        if ($query->content_type == 1) {
                            $data_update['proxy_type'] = $item['category']['categorytype']['name'] ?? null;
                            $data_update['proxy_type_name'] = $item['category']['name'] ?? null;
                            $data_update['package_code'] = $item['id'] ?? null;
                            $data_update['package_name'] = $item['name'] ?? null;
                            $data_update['expiry_time'] = null;
                            $data_update['use_time_min'] = null;
                            $data_update['status'] = 1;
                            $data_update['content'] = json_encode($item);
                        }
                        $check->update($data_update);
                    } else {
                        Proxy::updateOrCreate(
                            ['package_code' => $item['id']], // điều kiện update
                            [
                                'user_id'     => auth()->user()->id,
                                'api_id'     => $query->id,
                                'proxy_type'     => $item['category']['categorytype']['name'] ?? null,
                                'proxy_type_name' => $item['category']['name'] ?? null,
                                'package_code'   => $item['id'] ?? null,
                                'package_name'   => $item['name'] ?? null,
                                'price'          => $this->roundVND(($item['price'] + ($item['price'] * $query->price_increase) / 100), $query->price_type),
                                'expiry_time'    =>  null,
                                'use_time_min'   => null,
                                'status'         => 1,
                                'content'        => json_encode($item), // lưu raw data
                            ]
                        );
                    }
                }
            }

            return redirect()->back()->with(['success' => 'API run successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function create(Request $request)
    {
        try {
            $response = Http::get($request->link . $request->token);

            if ($response->failed()) {
                return redirect()->back()->with(['error' => 'API request failed']);
            }

            $data = $response->json();
            // dd($request->link . $request->token, $data);

            // Kiểm tra API trả về đúng data không
            if (!isset($data['Data'])) {
                return redirect()->back()->with(['error' => 'Invalid API response']);
            }

            foreach ($data['Data'] as $item) {
                Proxy::updateOrCreate(
                    ['package_code' => $item['package_code']], // điều kiện update
                    [
                        'proxy_type'     => $item['proxy_type'] ?? null,
                        'proxy_type_name' => $item['proxy_type_name'] ?? null,
                        'package_code'   => $item['package_code'] ?? null,
                        'package_name'   => $item['package_name'] ?? null,
                        'price'          => $item['price'] ?? null,
                        'expiry_time'    => $item['expiry_time'] ?? null,
                        'use_time_min'   => $item['use_time_min'] ?? null,
                        'status'         => 1,
                        'content'        => '', // lưu raw data
                    ]
                );
            }

            return redirect()->back()->with(['success' => 'Data saved successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Request $request, string $proxy_type)
    {
        try {
            TestFun::CheckTrans();
            $data_name = Proxy::where('proxy_type', $proxy_type)
                ->where('status', 1)
                ->first();

            if ($data_name->api_id == 2) {
                $data = Proxy::where('proxy_type', $proxy_type)
                    ->where('status', 1)
                    ->get();
                // ->groupBy('use_time_min');
            } else {
                $data = Proxy::where('proxy_type', $proxy_type)
                    ->where('status', 1)
                    ->get()
                    ->groupBy('use_time_min');
            }


            return view('shop.proxy.show', ["data" => $data, 'data_name' => $data_name]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = Proxy::findOrFail($id);

            $request->validate([
                'package_name' => 'required|string|max:255',
                'price' => 'required',
                'status' => 'required',
            ]);
            // dd($request->all());

            $user->update($request->only('price', 'package_name', 'status'));

            return redirect()->route('proxy.index')->with('success', 'Cập nhật gói proxy thành công!');
        } catch (Exception $e) {
            return redirect()->route('proxy.index')->with('error', $e->getMessage());
        }
    }

    public function api_update(Request $request, string $id)
    {
        try {
            $user = CallApi::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'price_increase' => 'required',
                'link' => 'required',
                'token' => 'required',
                'price_type' => 'required',
                'status' => 'required',
                'content_type' => 'required'
            ]);
            // dd($request->all());

            $user->update($request->only('title', 'price_increase', 'link', 'token', 'price_type', 'status', 'content_type'));

            return redirect()->route('api.index')->with('success', 'Cập nhật API thành công!');
        } catch (Exception $e) {
            return redirect()->route('api.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
