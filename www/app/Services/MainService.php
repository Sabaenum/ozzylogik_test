<?php

namespace App\Services;

use GuzzleHttp\Client;

abstract class MainService
{
    protected string $baseUrl = '';
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }
}
