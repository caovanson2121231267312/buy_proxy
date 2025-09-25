<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VietQrService
{
    protected $clientId;
    protected $apiKey;
    protected $url;

    public function __construct()
    {
        $this->clientId = env('VIETQR_CLIENT_ID');
        $this->apiKey   = env('VIETQR_API_KEY');
        $this->url      = env('VIETQR_URL', 'https://api.vietqr.io/v2/generate');
    }

    /**
     * Gọi API tạo QR Code
     */
    public function generate(array $payload)
    {
        $response = Http::withHeaders([
            'x-client-id' => $this->clientId,
            'x-api-key'   => $this->apiKey,
            'Content-Type'=> 'application/json',
        ])->post($this->url, $payload);

        return $response->json();
    }
}
