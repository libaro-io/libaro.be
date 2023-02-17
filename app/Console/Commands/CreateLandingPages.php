<?php

namespace App\Console\Commands;

use App\Services\LandingPageGenerator;
use Illuminate\Console\Command;

class CreateLandingPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landingpages:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate AI based landingpages';

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
        $lc = new LandingPageGenerator();
        $lc->handle();

        return 0;
    }
}
