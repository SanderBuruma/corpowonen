<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScrapeController;
use Illuminate\Console\Command;

class scrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the scrape';

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
     * @return mixed
     */
    public function handle()
    {
        error_log("Initiating full scrape");
        ScrapeController::ScrapeAll();
    }
}
