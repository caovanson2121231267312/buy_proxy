<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class VerifyUserEmail extends Command
{
    /**
     * Tên và cú pháp lệnh artisan
     *
     * @var string
     */
    protected $signature = 'user:verify {id}';

    /**
     * Mô tả lệnh
     *
     * @var string
     */
    protected $description = 'Xác thực email cho user theo ID';

    /**
     * Thực thi command
     */
    public function handle()
    {
        $id = $this->argument('id');


        $user = User::find($id);

        if (!$user) {
            $this->error("Không tìm thấy user với ID {$id}");
            return Command::FAILURE;
        }

        if ($user->hasVerifiedEmail()) {
            $this->info("User ID {$id} đã được xác thực trước đó.");
            return Command::SUCCESS;
        }

        $user->markEmailAsVerified();

        $this->info("✅ Đã xác thực email cho user ID {$id}");
        return Command::SUCCESS;
    }
}
