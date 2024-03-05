<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class NBUStatService extends MainService
{
    protected string $baseUrl = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json';
    protected Client $client;

    public function getRates()
    {
        try {
            $response = $this->client->get("");
            $response = json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            Log::debug($e->getMessage());
            return false;
        }
        return $response;
    }
}
