<?php

namespace App\Jobs;

use App\Models\BankRates;
use App\Models\Banks;
use App\Services\MinfinService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateMinfinRates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private array $currencyList = ['USD', 'EUR', 'GBP', 'CHF', 'PLN'];
    private MinfinService $financeService;

    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->financeService = new MinfinService();
        foreach ($this->currencyList as $currency) {
            $this->getRates($currency);
        }
    }

    public function getRates($currency)
    {
        try {
            $response = $this->financeService->getRates($currency);
            if ($response) {
                $this->insertRates($response, $currency);
            }
        } catch (\Exception|GuzzleException $e) {
            Log::debug($e->getMessage());
            $this->fail();
        }
    }

    private function insertRates($rates, $currency)
    {
        $rateInsert = [];
        foreach ($rates as $rate) {
            $id = Banks::idBySlug($rate->slug)->first()->id ?? false;
            if ($id && isset($rate->cash->bid) && isset($rate->cash->ask)) {
                $rateInsert[] = [
                    'code' => $currency,
                    'bankId' => $id,
                    'bid' => $rate->cash->bid,
                    'ask' => $rate->cash->ask,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        BankRates::insert($rateInsert);
    }
}
