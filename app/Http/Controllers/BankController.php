<?php

namespace App\Http\Controllers;

use App\Services\Web2mService;

class BankController extends Controller
{
    protected $web2m;

    public function __construct(Web2mService $web2m)
    {
        $this->web2m = $web2m;
    }

    public function index()
    {
        $transactions = $this->web2m->getTransactions();

        dd($transactions);

        return response()->json($transactions);
    }
}
