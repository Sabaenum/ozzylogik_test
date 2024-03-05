<?php

namespace App\Jobs;

use App\Models\Banks;
use App\Models\Branches;
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

class UpdateBranches implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public FinanceService $financeService;

    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->financeService = new FinanceService();
        $banks = Banks::all();
        Branches::truncate();
        if ($banks) foreach ($banks as $bank) {
            $this->getBranches($bank);
        }
    }

    private function getBranches($bank)
    {
        try {
            $branches = $this->financeService->getBranches($bank->slug);
            if ($branches) {
                $this->insertBranches($branches, $bank->id);
            }
        } catch (\Exception|GuzzleException $e) {
            Log::debug($e->getMessage());
            $this->fail();
        }
    }

    private function insertBranches(mixed $branches, int $id)
    {
        array_map(function ($branch) use ($id) {
            Branches::create([
                'updated_at' => Carbon::now(),
                'slug' => $branch->slug,
                'created_at' => Carbon::now(),
                'data' => $branch->data,
                'bankId' => $id,
            ]);
        }, $branches);
    }
}
