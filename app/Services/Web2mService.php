<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Web2mService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey  = "2761adeb04828619aef101d852369c696e7dd67df32eddfb94ec14bc87a58405";
        $this->baseUrl = "https://api.web2m.com/historyapiacbv3/Son20121999/8639381/903B1609-9BBF-C4D7-7437-437201E97DB5";
    }

    /**
     * Lấy lịch sử giao dịch ngân hàng
     */
    public function getTransactions()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey
            ])->get($this->baseUrl);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'status' => false,
                'message' => $response->body()
            ];
        } catch (Exception $e) {
            dump($e);
        }
    }
}
