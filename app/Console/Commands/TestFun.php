<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Transaction;
use App\Services\Web2mService;
use Illuminate\Console\Command;

class TestFun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-fun';

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
        TestFun::CheckTrans();
    }


    public static function CheckTrans() {
        $web2m = new Web2mService();
        $transactions = $web2m->getTransactions();

        // dump($transactions['transactions']);
        if ($transactions['transactions']) {

            foreach ($transactions['transactions'] as $value) {
                if ($value['type'] == "IN") {
                    $data_insert = [];
                    $data_insert['transactionID'] = $value['transactionID'];
                    $data_insert['amount'] = $value['amount'];
                    $data_insert['note'] = $value['description'];
                    $data_insert['method'] = 'bank';
                    $data_check = Transaction::where("transactionID", $value['transactionID'])->first();
                    if(!empty($data_check)) {
                        // dump(preg_match('/\.?(BUYPROXY[0-9]+)\./', $value['description'], $matches));
                        continue;
                    }
                    // dd($transactions['transactions']);

                    if (preg_match('/BUYPROXY\d+/i', $value['description'], $matches)) {
                        $code = $matches[0];
                        $userId = str_replace("BUYPROXY", "", $code);
                        $user = User::find($userId);
                        if (!empty($user)) {
                            $data_insert['user_id'] = $user->id;
                            $data_insert['status'] = 'success';

                            $user->update([
                                "price" => $user->price +  $value['amount'],
                            ]);
                        } else {
                            $data_insert['status'] = 'pending';
                        }
                    } else {
                        $code = null;
                        $data_insert['status'] = 'pending';
                    }

                    // dd($data_insert);

                    Transaction::create($data_insert);
                }
            }
        }
    }
}
