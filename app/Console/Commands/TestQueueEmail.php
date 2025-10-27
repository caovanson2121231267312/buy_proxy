<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendTestEmail;

class TestQueueEmail extends Command
{
    protected $signature = 'test:queue-email';
    protected $description = 'Test queue email sending';

    public function handle()
    {
        $email = "son1669063793@gmail.com";

        SendTestEmail::dispatch($email);

        $this->info("✅ Email queued to send to: $email");
        return 0;
    }
}
