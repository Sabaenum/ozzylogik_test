<?php

namespace App\Jobs;

use App\Models\Banks;
use App\Services\FinanceService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateBanks implements ShouldQueue
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
            $financeService = new FinanceService();
            $banks = $financeService->getBanks();
            if ($banks) {
                $this->insertBanks($banks);
            }
        } catch (\Exception|GuzzleException $e) {
            Log::debug($e->getMessage());
            $this->fail();
        }
    }

    private function insertBanks($banks): void
    {
        foreach ($banks as $bank) {
            $bankInsert[] = [
                'description' => $bank->longTitle,
                'title' => $bank->title,
                'slug' => $bank->slug,
                'site' => $bank->site,
                'ratingBank' => $bank->ratingBank,
                'phone' => $bank->phone,
                'logo' => $bank->logo[1],
                'legalAddress' => $bank->legalAddress,
                'email' => $bank->email,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        Banks::truncate();
        Banks::insert($bankInsert);
    }
}
