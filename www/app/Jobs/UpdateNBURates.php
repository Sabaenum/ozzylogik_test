<?php

namespace App\Jobs;

use App\Models\Banks;
use App\Models\NbuRates;
use App\Services\NBUStatService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateNBURates implements ShouldQueue
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
        $nbuStatService = new NBUStatService();
        try {
            $response = $nbuStatService->getRates();
            if ($response) {
                $this->insertRates($response);
            }
        } catch (\Exception|GuzzleException $e) {
            Log::debug($e->getMessage());
            $this->fail();
        }
    }

    private function insertRates($rates)
    {
        $ratesInsert = array_map(function ($rate){
            return [
                'code' => $rate->cc,
                'rate' => $rate->rate,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }, $rates);
        NbuRates::insert($ratesInsert);
    }
}
