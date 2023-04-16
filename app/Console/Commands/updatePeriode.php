<?php

namespace App\Console\Commands;

use App\Models\Periode;
use Illuminate\Console\Command;

class updatePeriode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:periode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated status periode';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Update when the date now()
        Periode::whereDate('expired_periode','=',date('Y-m-d'))->update(['status'=>0]);
        
        $this->info("Periode update successfully!");
        $this->info("Cron is working fine!");
    }
}
