<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

trait ApiHeart
{
    public function initHttpWithToken(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders())->withToken($this->getBeeToken());
    }

    public function apiHeaders(): array
    {
        return ['Accept' => 'application/json', 'Content-Type' => 'application/json', 'api-version' => '1'];
    }

    public function getBeeToken(): string
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

        if (!session()->has('_doptor_token') || session('_doptor_token') == '') {
            $token = $this->getClientToken($url, $client_id, $client_pass, $username);
            session(['_doptor_token' => $token]);
        }
        return session('_doptor_token');
    }

    public function getClientToken($url, $client_id, $client_pass, $username = '')
    {
        if ($username == '') {
            $getToken = $this->initHttp()->post($url, ['client_id' => $client_id, 'password' => $client_pass]);
        } else {
            $getToken = $this->initHttp()->post($url, ['client_id' => $client_id, 'password' => $client_pass, 'username' => $username,]);
        }

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

    public function initRPUHttp(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->apiHeaders())->withToken($this->getRPUniverseToken());
    }

    public function getRPUniverseToken()
    {
        $url = config('cag_rpu_api.auth.client_login_url');
        $client_id = config('cag_rpu_api.auth.client_id');
        $client_pass = config('cag_rpu_api.auth.client_pass');
        if (!session()->has('_rpu_token') || session('_rpu_token') == '') {
            $token = $this->getClientToken($url, $client_id, $client_pass, $this->getUsername());
            session(['_rpu_token' => $token]);
        }
        return session('_rpu_token');
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

    public function fileUPloadWithData($method = 'POST', $uri, $data): \Psr\Http\Message\ResponseInterface
    {
        $client = new Client();
        $response = $client->request(
            $method,
            $uri,
            [
                'multipart' => $data,
                'headers' => [
                    'Authorization' => "Bearer " . $this->getBeeToken(),
                    'Accept' => 'application/json',
                    'api-version' => '1',
                ],
            ]
        );
        return $response;
    }
}
