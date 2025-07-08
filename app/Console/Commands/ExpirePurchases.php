<?php

namespace App\Console\Commands;

use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class ExpirePurchases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purchases:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire purchases that have reached their expiration date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Expiring purchases...');
        
        $now = Carbon::now();

        $count = Purchase::where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '<', $now)
            ->update(['status' => 'expired']);

        $this->info("Expired $count purchases.");
    }
}
