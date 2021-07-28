<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiHeart
{
    public function initHttpWithToken(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders())->withToken($this->getClientToken());
    }

    public function apiHeaders(): array
    {
        return ['Accept' => 'application/json', 'Content-Type' => 'application/json', 'api-version' => '1'];
    }

    public function getClientToken(): string
    {
        return $this->checkLogin() ? session('login')['data']['token'] : '';
    }

    public function initDoptorHttp(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders())->withToken($this->getDoptorToken($this->getUsername()));
    }

    public function getDoptorToken($username)
    {
        $url = config('cag_doptor_api.auth.client_login_url');
        $client_id = config('cag_doptor_api.auth.client_id');
        $client_pass = config('cag_doptor_api.auth.client_pass');

        $getToken = $this->initHttp()->post($url, ['client_id' => $client_id, 'password' => $client_pass, 'username' => $username,]);

        if ($getToken->status() == 200 && $getToken->json()['status'] == 'success') {
            return $getToken->json()['data']['token'];
        } else {
            return '';
        }
    }

    public function initHttp(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders());
    }

    public function loginIntoCagBeeCore($data)
    {
        $response = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json', 'api-version' => '1', 'device-id' => 'avc', 'device-type' => 'web'])->post(config('amms_bee_routes.login_in_cag_bee'), ['user_data' => $data])->json();


        if (is_array($response) && isset($response['status']) && $response['status'] == 'success') {
            session()->put('login', $response);
            session()->save();
            return session('login');
        }
        return null;
    }
}

