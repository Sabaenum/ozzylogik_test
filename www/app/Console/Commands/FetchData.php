<?php

namespace App\Console\Commands;

use App\Jobs\UpdateBanks;
use App\Jobs\UpdateBranches;
use App\Jobs\UpdateCurrency;
use App\Jobs\UpdateMinfinRates;
use App\Jobs\UpdateNBURates;
use Illuminate\Console\Command;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UpdateCurrency::dispatch();
        UpdateBanks::dispatch();
        UpdateBranches::dispatch();
        UpdateMinfinRates::dispatch();
        UpdateNBURates::dispatch();
    }
}
