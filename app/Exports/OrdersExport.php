<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths
{
    public function collection()
    {
        // Lấy danh sách order theo user đăng nhập
        return Order::with(['user', 'proxy' => function($q) {
                $q->with(['api_call']);
            }])->where('user_id', Auth::id())
            // ->select([
            //     'id',
            //     'name',
            //     'proxy',
            //     // 'price',
            //     // 'quantity',
            //     // 'total_price',
            //     // 'end_date',
            //     // 'auto_renew',
            //     'created_at',
            // ])
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Proxy',
            'IP',
            // 'Price',
            // 'Quantity',
            // 'Total Price',
            // 'End Date',
            // 'Auto Renew',
            'Created At',
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // ID
            'B' => 15,  // Tên Order
            'C' => 35,  // Tài khoản
            'D' => 25,  // Giá
            'E' => 22,  // Số lượng
        ];
    }

     public function map($order): array
    {
        $ip = '';

            $order->type = 3;
            if ($order->payload) {
                $payload = json_decode($order->payload);
                if(!empty(json_decode($order->payload, true)['Data'])) {
                    $order->type = 1;
                    $order->payload_data = json_decode($order->payload, true)['Data'] ?? [];
                    // dd($order->payload_data );

                    $ip = $order->payload_data[0]['public_origin_ip'] ?? '';
                } else {
                    // dd(json_decode($order->payload, true)['products'][0]);
                    $order->type = 2;
                    $payload = json_decode($order->payload, true)['products'][0] ?? [];
                    $id = $payload['order']['id'] ?? 0;

                    $response = Http::withToken($order->proxy->api_call->token) // ở đây author chính là token
                        ->get('https://api.homeproxy.vn/api/merchant/proxies?filter=orderId:$eq:string:' . $id);
                        // dump('https://api.homeproxy.vn/api/merchant/proxies?filter=orderId:$eq:string:' . $id, $payload, $response->json());

                    $order->payload_data = [];
                }
            }
            if(empty($order->end_date)) {
                $order->status = 0;
            } else {
                $order->end_date = Carbon::parse($order->end_date)->startOfDay()->format('d-m-Y');
                if(Carbon::parse($order->end_date)->startOfDay()->lt(Carbon::now()->startOfDay())) {
                    $order->status = 0;
                } else {
                    $order->status = 1;
                }
            }

        return [
            $order->id,
            ucfirst($order->user->name), // Viết hoa chữ đầu
            $order->proxy->package_name,
            $ip, // format tiền
            // $order->quantity,
            // number_format($order->total_price) . ' đ',
            // optional($order->end_date)->format('d/m/Y H:i'),
            // $order->auto_renew ? 'Có' : 'Không', // boolean thành chữ
            $order->created_at->format('d/m/Y H:i'),
        ];
    }
}
