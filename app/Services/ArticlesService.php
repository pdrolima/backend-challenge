<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ArticlesService
{
    public function request(string $endpoint)
    {
        $response = Http::acceptJson()->get("https://api.spaceflightnewsapi.net/v3/$endpoint");

        if ($response->successful()) {
            return $response->json();
        }
        // Throw an exception if a client or server error occurred...
        try {
            $response->throw();
        } catch (RequestException $e) {
            Log::error('Request Error to Space\'s API Flight News occurred.', [
                'error' => $e->getMessage(),
                'status_code' => $e->getCode()
            ]);
        }
    }
}
