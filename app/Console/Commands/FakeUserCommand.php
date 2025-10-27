<?php

namespace App\Console\Commands;

use App\Models\CallApi;
use App\Models\Order;
use App\Models\Proxy;
use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class FakeUserCommand extends Command
{
    /**
     * Tên lệnh để chạy
     *
     * @var string
     */
    protected $signature = 'fake:data';

    /**
     * Mô tả lệnh
     *
     * @var string
     */
    protected $description = 'Tạo 3 user fake để test';

    /**
     * Thực thi lệnh
     */
    public function handle()
    {
        // $check = User::find(2)->delete();
        $data = User::where('email', 'caovanson.coderjava@gmail.com')->first();
        $data->delete();
        // dd($data);

        return;
        $data = Order::find(2);
        $p = Proxy::limit(1)->orderBy('id', 'desc')->first();
        $up = 
         
            [
                "products" => [
                    [
                        "order" => [
                            "id" => "a52e421a-e3fa-46f3-81e6-15d6b1b79d07"
                        ]
                    ]
                ],
                "order" => [
                    'id' => "a52e421a-e3fa-46f3-81e6-15d6b1b79d07"
                ],
                "code" => "1KNZNQ",
                "prevIp" => null,
                "description" => null,
                "dayOfRenewal" => 0,
                "isRenewal" => false,
                "protocol" => "HTTP",
                "proxy" => [
                    "blockAt" => null,
                    "description" => null,
                    "rotateInterval" => null,
                    "idInbound" => "60",
                    "ipaddress" => [
                        "domain" => "proxy04101.gproxy.online",
                        "changeIpAt" => "2025-08-02T12:40:28.236Z",
                        "prevIp" => "171.241.69.132",
                        "location" => "HNI",
                        "provider" => "VIETTEL",
                        "categorytype" => [], // mình để mảng rỗng thay vì ▶
                        "ttl" => "6w19h32m49s",
                        "ip" => "171.241.12.208",
                        "id" => "3469fc83-6c3b-4682-807b-bd018e89afcf",
                        "createdAt" => "2025-06-20T23:13:56Z",
                        "updatedAt" => "2025-09-26T10:22:12Z",
                        "deletedAt" => null
                    ],
                    "password" => "MdrgTuvCm",
                    "username" => "sonvip",
                    "port" => 10405,
                    "id" => "3f372ef2-f8c2-4257-8e6d-4a47f14e20ba",
                    "createdAt" => "2025-09-16T11:08:58Z",
                    "updatedAt" => "2025-09-26T10:22:12Z",
                    "deletedAt" => null
                ],
                "expiredAt" => 1758943332071,
                "status" => [
                    "id" => 6,
                    "name" => "Completed",
                    "__entity" => "StatusEntity"
                ],
                "userId" => "3c9fb765-3759-432e-9106-ae1718eda90b",
                "orderId" => "a52e421a-e3fa-46f3-81e6-15d6b1b79d07",
                "id" => 73068,
                "createdAt" => "2025-09-26T10:22:12Z",
                "updatedAt" => "2025-09-26T10:22:24Z"
            ]
         
    ;
        $data->update([
            'payload' => json_encode($up),
            'proxy_id' => $p->id
        ]);
        dd($data);
        $users = [
            ['name' => 'admin', 'email' => 'admin@gmail.com'],
            // ['name' => 'User Two', 'email' => 'user2@example.com'],
            // ['name' => 'User Three', 'email' => 'user3@example.com'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('12345678'),
                    'role' => 1,
                ]
            );
        }

        $data = [
            [
                'title' => 'm2proxy',
                'token' => '9bcd2ff417b78f413e4e0ef5e7f46ada',
                'link' => 'https://api.m2proxy.com/user/data/getpackages?token=',
                'user_id' => 1,
            ],
            [
                'title' => 'homeproxy',
                'token' => '$2b$10$UcaurK.vEb5TStuHOSi79uqp/6TUE3vrzR.KGVTr51v6lkOA83BIC',
                'link' => 'https://api.homeproxy.vn/api/merchant/products',
                'user_id' => 1,
            ]
        ];

        foreach ($data as $value) {
            CallApi::updateOrCreate(
                ['title' => $value['title']],
                [
                    'title' => $value['title'],
                    'token' => $value['token'],
                    'link' => $value['link'],
                    'user_id' => $value['user_id'],
                ]
            );
        }

        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
        $this->info('✅ Done!');
    }
}
