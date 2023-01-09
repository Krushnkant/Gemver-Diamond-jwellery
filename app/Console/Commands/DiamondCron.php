<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\ImportDiamondNewLatest;
use Excel;

class DiamondCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diamond:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diamond Sheet Uploaded';

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
        
        set_time_limit(0);
        //$public_path = public_path() . "\csv\diamond_response.csv";
        $public_path = __DIR__ . '/../../../public/csv/vdb_LG_diamonds.csv';
        Excel::import(new ImportDiamondNewLatest, $public_path);
        $action = "add";
        \Log::info("Cron is working fine!");
        //return response()->json(['status' => '200', 'action' => $action]);
    }
}
