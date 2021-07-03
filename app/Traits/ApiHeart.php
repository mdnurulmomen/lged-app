<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiHeart
{
    public function initHttpWithClientToken($username): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders())->withToken($this->getClientToken($username));
    }

    public function apiHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'api-version' => '1'
        ];
    }

    public function initHttp(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders());
    }
}

