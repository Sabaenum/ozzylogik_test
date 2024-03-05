<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class FinanceService extends MainService
{
    protected string $baseUrl = 'https://finance.ua/';
    protected Client $client;

    public function getBanks($locale = 'uk')
    {
        try {
            $response = $this->client->get("banks/api/organizationsList", ['query' => ['locale' => $locale]]);
            $response = json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            Log::debug($e->getMessage());
            return false;
        }
        return $response->responseData ?? false;
    }

    public function getBranches($slug = 'ukrsibbank', $locale = 'uk')
    {
        try {
            $response = $this->client->get("/api/organization/v1/branches", ['query' => ['slug' => $slug, 'locale' => $locale]]);
            $response = json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            Log::debug($e->getMessage());
            return false;
        }
        return $response->data ?? false;
    }
}
