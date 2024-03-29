<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ParariusController;

class scrapeadvertentiepararius extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapeadvertentiepararius';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape a specific pararius advert and return its properties';

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
        // /huis-te-koop/amsterdam/4c57a5ce/anton-hoelzelsingel
        ParariusController::ScrapeAdvertenties(["/huis-te-koop/amsterdam/4c57a5ce/anton-hoelzelsingel"]);
    }
}
