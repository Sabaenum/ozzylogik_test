<?php

namespace App\Jobs;

use App\Models\Currency;
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

class UpdateCurrency implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $financeService = new MinfinService();
            $currencyList = $financeService->getCurrency();
            if ($currencyList) {
                $this->insertCurrency($currencyList);
            }
        } catch (\Exception|GuzzleException $e) {
            Log::debug($e->getMessage());
            $this->fail();
        }
    }

    private function insertCurrency(mixed $currencyList)
    {
        $currencyInsert = array_map(function ($currency){
            return [
                'code' => $currency->code,
                'iso' => $currency->iso,
                'name' => $currency->name,
                'slug' => $currency->slug,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }, $currencyList);
        Currency::truncate();
        Currency::insert($currencyInsert);
    }
}
