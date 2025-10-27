<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class UpdateOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Order::with([
            'user' => function ($q) {
                $q->withSum('trans', 'amount');
            },
            'proxy' => function ($q) {
                $q->with(['api_call']);
            }
        ])->get();

        foreach($query as $value) {
            // dd($value->proxy->api_call->price_increase);
            $updatev = Order::find($value->id);
            $updatev->profit = $value->proxy->api_call->price_increase;
            $updatev->save();
            $this->info($value->id);
        }
    }
}
