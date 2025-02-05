<?php

namespace App\Http\Adapters;

use Illuminate\Support\Facades\Http;

class HttpClientAdapter implements HttpClientInterface
{
    private string $apiBaseUri;
    private string $apiKey;

    public function __construct(){
        $this->apiBaseUri = env('API_FOOTBALL_BASE_URI', 'https://v3.football.api-sports.io/');
        $this->apiKey = env('API_FOOTBALL_KEY');
    }

    public function get(string $endpoint, array $queryParams = [])
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => $this->apiKey,
        ])->withoutVerifying()->get($this->apiBaseUri . $endpoint, $queryParams);

        return $response->json();
    }
}
