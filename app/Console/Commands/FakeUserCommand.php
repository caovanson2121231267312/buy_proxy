<?php

namespace App\Console\Commands;

use App\Models\CallApi;
use Illuminate\Console\Command;
use App\Models\User;
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
