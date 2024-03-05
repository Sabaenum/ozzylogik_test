<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class MinfinService extends MainService
{
    protected string $baseUrl = 'https://minfin.com.ua/api/currency/';
    protected Client $client;

    public function getCurrency($type = 'money', $locale = 'uk')
    {
        try {
            $response = $this->client->get("list", ['query' => ['type' => $type, 'locale' => $locale]]);
            $response = json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            Log::debug($e->getMessage());
            return false;
        }
        return $response->list ?? false;
    }

    public function getRates($currency = 'USD', $limit = 100)
    {
        try {
            $response = $this->client->get("rates/banks/{$currency}", ['query' => ['cpp' => $limit]]);
            $response = json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            Log::debug($e->getMessage());
            return false;
        }
        return $response->data ?? false;
    }
}
